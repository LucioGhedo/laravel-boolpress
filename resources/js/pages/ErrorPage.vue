<template>
    <div class="back">
        <h2 class="title_ms">Pagina non trovata</h2>
        <h2 class="mt-5">Torna alla 
            <router-link :to="{name: 'blog'}">pagina del Blog</router-link>
        </h2>
        <p>
            Oppure torna alla 
            <router-link :to="{name: 'home'}">HomePage</router-link>
        </p>
    </div>
</template>

<script>
export default {
    name: 'ErrorPage',
}
</script>

<style lang="scss" scoped>
.back {
    background-image: url('https://klizos.com/wp-content/uploads/funny-404-error-page-GIF-klizo-solutions.gif');
    height: 576px;
    color: white;

    h2 {
        padding-left: 30px;
    }
    p {
        padding-left: 30px;
    }
    .title_ms {
        padding-top: 30px;
    }
}
a {
    color: red;
    text-decoration: underline;
}
</style>