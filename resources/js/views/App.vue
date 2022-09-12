<template>
    <div>
        <header>
            <a href="/admin">Admin privata</a>
        </header>
        <main>
            <Posts />
        </main>
    </div>
</template>


<script>
    import Posts from '../components/Posts.vue';
    
    export default {
        name: 'App',
        components: {
            Posts
        }
    }
    </script>