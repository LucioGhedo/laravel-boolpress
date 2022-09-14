<template>
    <div class="container">
        <h2>{{ pageTitle }}</h2>
        <div class="row row-cols-3">
            <div class="col-sm-4" v-for="singlePost in posts" :key="singlePost.id">
                <PostDetails :post="singlePost"/>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination mt-5">
                    <li class="page-item" :class="{'disabled': currentPage === 1}">
                        <a class="page-link" @click.prevent="getPost(currentPage - 1)" href="#">Previous</a>
                    </li>
                    <li class="page-item" :class="{'active': currentPage === activePage}" v-for="activePage in lastPage" :key="activePage">
                        <a class="page-link" @click.prevent="getPost(activePage)" href="#">{{activePage}}</a>
                    </li>
                    <li class="page-item" :class="{'disabled': currentPage === lastPage}">
                        <a class="page-link" @click.prevent="getPost(currentPage + 1)" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>    
    </div>
</template>

<script>
import PostDetails from './PostDetails.vue';

export default {
    name: 'Posts',
    components: {
        PostDetails
    },
    data() {
        return {
            pageTitle: 'I nostri post',
            posts: [],
            currentPage: 1,
            string: 1,
            lastPage: 0
        };
    },
    methods: {
        shortText(text) {
            if(text.length > 75) {
                return text.slice(0, 75) + '...';
            } else {
                return text;
            }
        },
        getPost(currentPage) {
            axios.get('/api/posts',{
                params: {
                    page: currentPage
                }
            })
            .then((response) => {
                this.posts = response.data.result.data;
                this.currentPage = response.data.result.current_page;
                this.lastPage = response.data.result.last_page;
            });
        },
    },
    mounted() {
        this.getPost();
    }
}
</script>

<style scoped lang="scss">
.f_height {
    min-height: 200px;
}
</style>