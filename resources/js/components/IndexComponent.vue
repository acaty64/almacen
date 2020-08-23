<template>
  <div class="container">
		<div v-if="waiting" class="card-body">
			<img src="/images/wait.gif"/>
		</div>
		<div v-if="loaded" class="card-body">
			<div v-if="preview" class="row">
				<button v-on:click="getPreview" class="btn btn-primary">
					Vista Preliminar
				</button>
			</div>

			<div v-if="checking" class="row">
				<button v-on:click="setCheck(true)" class="btn btn-primary">
					Aprobado
				</button>
				<button v-on:click="setCheck(false)" class="btn btn-primary">
					Desaprobado
				</button>
			</div>

			<div v-if="checked" class="row">
				<button v-on:click="download" class="btn btn-primary">
					Descargar archivo
				</button>
			</div>

			<div v-if="unchecked" class="row">
				<div class="row">
					<button v-on:click="saveComment" class="btn btn-primary">
						Grabar comentario
					</button>
				</div>
				<div class="row">
					<div class="col-md-12">
						<textarea v-model="comment"></textarea>
					</div>
				</div>
			</div>
		</div>

		<div v-if="checking" class="card-body">
			<div class="row">
				<div class="col-md-12">
					<iframe :src="filepreview" style="width: 100%; height:50vw; position: relative; allowfullscreen;"></iframe>
				</div>
			</div>
		</div>		
  </div>
</template>

<script>
  export default {
    props: ['user_id'],

    data() {
    	return {
    		waiting: true,
				preview: false,
				loaded: false,
				filepreview: '',
				filedownload: '',
				namedownload: '',
				comment: '',
				checked: false,
				unchecked: false,
				loaded: false,
				checking: false,
    	}
    },

    mounted() {
        console.log('Component mounted.')
        this.getData();
    },

    methods: {
    	saveComment() {
    		var request = this.comment;
        var URLdomain = window.location.host;
        var protocol = window.location.protocol;
        axios.post(url, request).then(response => {
					
    			// this.checked = true;
    			// this.unchecked = false;
    			// this.waiting = false;
    			// this.checking = false;

        }).catch(function (error) {
        	console.log('error saveComment', error);
        });
			},    	

			download(){
        var URLdomain = window.location.host;
        var protocol = window.location.protocol;
		    // var url = protocol+'//'+URLdomain+this.filepreview;
		    var url = this.filedownload;
				axios({
						url: url,
            method: 'GET',
            responseType: 'blob',
        }).then((response) => {
             var fileURL = window.URL.createObjectURL(new Blob([response.data]));
             var fileLink = document.createElement('a');

             fileLink.href = fileURL;
             fileLink.setAttribute('download', this.namedownload);
             document.body.appendChild(fileLink);

             fileLink.click();
        });
			},    	
    	
    	getPreview() {
    		this.checking = true;
    		this.preview = false;
    	},
    	
    	getData() {
    		this.waiting = true;

        var URLdomain = window.location.host;
        var protocol = window.location.protocol;
        var url = protocol + '//' + URLdomain + '/api/check/getdata/' + this.user_id;
        axios.get(url).then(response => {
					console.log('getData: ', response);
	    		// this.filepreview = 'http://store.ucssfcec.work/storage/docs/prueba.pdf';
	    		this.filepreview = protocol + '//' + URLdomain + response.data.path + response.data.filename ;
	    		this.preview = true;
	    		this.waiting = false;
	    		this.loaded = true;     	
        }).catch(function (error) {
        	console.log('error getData', error);
        });
    	},

    	setCheck(value){
    		if(value){
    			this.waiting = true;
	        var URLdomain = window.location.host;
	        var protocol = window.location.protocol;
	        var url = protocol + '//' + URLdomain + '/api/check/setcheck/' + this.user_id;
	        axios.get(url).then(response => {
				console.log('setCheck: ', response);
	    		this.namedownload = response.data.filename;
	    		// this.filedownload = 'http://store.ucssfcec.work/storage/check/prueba_aprobado.pdf';
    			this.filedownload = protocol + '//' + URLdomain + response.data.path + response.data.filename ;

    			this.checked = true;
    			this.unchecked = false;
    			this.waiting = false;
    			this.checking = false;

	        }).catch(function (error) {
	        	console.log('error getData', error);
	        });

    		}else{
    			this.unchecked = true;
    			this.checked = false;
    			this.preview = false;
    			this.checking = false;
    		}
    	}
    },

  };
</script>

<style type="text/css">
    html, body, div#content { margin:0; padding:0; height:100%; }
    iframe { display:block; width:100%; border:none; }
</style>