<template>
    <div>
        <h1>About</h1>
        <div class="back">
            <div>
                <h2>Creato da {{myName}}</h2>
                <a href="http://lucioghedina.onweb.im/">:)</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AboutPage',
    data() {
        return {
            myName: 'Lucio Ghedina'
        }
    }
}
</script>

<style lang="scss" scoped>
.back {
    height: 700px;
    width: 100%;
    background-image: url('https://images6.alphacoders.com/111/1119425.jpg');
    background-size: 1200px 700px;

    div {
        padding-top: 360px;
        padding-left: 97px;
        color: white;
    }
    a {
        font-size: 90px;
    }
}
</style>