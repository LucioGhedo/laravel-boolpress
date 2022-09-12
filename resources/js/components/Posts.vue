<template>
    <div class="container">
        <h1>{{ pageTitle }}</h1>
        <div class="row row-cols-3">
            <div class="col-sm-4" v-for="post in posts" :key="post.id">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">{{post.title}}</h5>
                        <p class="card-text">{{shortText(post.content)}}</p>
                    </div>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination mt-5 text-center">
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
</template>

<script>
import Axios from 'axios';

export default {
    name: 'Posts',
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