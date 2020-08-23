<template>
    <div class="container">                    
      <ul>
        <li v-for="facultades in item">
            {{ item.name }}
        </li>
      </ul>
    </div>
</template>

<script>
    export default {
        props: ['facultades'],
        mounted() {
            console.log('Component mounted.')
        }
    };
</script>
