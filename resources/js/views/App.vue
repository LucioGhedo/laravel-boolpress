<template>
    <div>
        <HeaderComponent />
        <main>
            <div class="container">
                <router-view></router-view>
            </div>
        </main>
    </div>
</template>


<script>
import HeaderComponent from '../components/HeaderComponent.vue';

    export default {
        name: 'App',
        components: {
            HeaderComponent
        }
    }
    </script>