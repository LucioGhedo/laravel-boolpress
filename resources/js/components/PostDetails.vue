<template>
    <div class="card mt-3 f_height">
        <div class="card-body">
            <h5 class="card-title">{{post.title}}</h5>
            <p class="card-text">{{shortText(post.content)}}</p>
            <router-link 
                class="btn btn-dark" 
                :to="{
                    name: 'single-post', 
                    params: { slug: post.slug 
                    }}">
                Info
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PostDetails',
    methods: {
        shortText(text) {
            if(text.length > 75) {
                return text.slice(0, 75) + '...';
            } else {
                return text;
            }
        }
    },
    props: {
        post: Object
    }
}
</script>