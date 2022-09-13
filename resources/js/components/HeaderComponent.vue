<template>
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <router-link :to="{name: 'home'}" class="navbar-brand">HomePage</router-link>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <div v-for="item in menuLinks" :key="item.id">
                                <li class="nav-item">
                                    <router-link class="nav-link active" :to="{name: item.name}">{{item.label}}</router-link>
                                </li>
                            </div>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
</template>

<script>
export default {
    name: 'HeaderComponent',
    data() {
        return {
            menuLinks: [
                {
                    name: 'blog',
                    label: 'Blog'
                },
                {
                    name: 'about',
                    label: 'About'
                }
            ]
        }
    }
}
</script>