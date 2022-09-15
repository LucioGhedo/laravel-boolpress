<template>
    <div>
        <div class="mt-4" v-if="post">
            <h1>{{post.title}}</h1>
            <img :src="post.cover" class="card-img-top w-50 text-center" :alt="post.title" v-if="post.cover">
            <div>
                <div v-if="post.tags.length !== 0" class="tags text-center mt-3">
                    TAGS:
                    <div>
                        <button v-for="item in post.tags" :key="item.id" type="button" class="btn btn-primary position-relative">
                            {{item.name}}
                        </button>
                    </div>
                </div>
            </div>
            <p>{{post.content}}</p>
            <div v-if="post.category">Categoria: {{post.category.name}}</div>
        </div>
        <div class="text-center mt-4" v-else>
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c7/Loading_2.gif?20170503175831" class="text-center" alt="loading">
        </div>
    </div>
</template>

<script>
export default {
    name: 'SinglePost',
    data() {
        return {
            post: null
        }
    },
    mounted() {
        axios.get('/api/posts/' + this.$route.params.slug)
        .then((response) => {
            if(response.data.success) {
                this.post = response.data.results;
            } else {
                this.$router.push({name: 'error'});
            }
        });

    }
}
</script>

<style lang="scss" scoped>
.tags {
    width: fit-content;
    margin: auto;
    border: solid black 1px;
    margin-bottom: 50px;
    div {
        margin-right: 20px;
        button {
            margin-left: 20px;
            margin-bottom: 15px;
        }
    }
}
</style>