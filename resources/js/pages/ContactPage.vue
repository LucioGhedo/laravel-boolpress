<template>
    <div class="container">
        <h1>Contattaci</h1>

        <div v-if="success" class="alert alert-success" role="alert">
            Messaggio inviato!
        </div>


        <form @submit.prevent="sendMessage">
            <div class="form-group">
                <label for="formGroupExampleInput">Nome</label>
                <input v-model="userName" type="text" class="form-control" id="formGroupExampleInput" placeholder="Nome">
            </div>
            <div v-if="errors.name">
                <div v-for="error, index in errors.name" :key="index" class="alert alert-danger" role="alert">
                    {{error}}
                </div>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Email</label>
                <input v-model="userEmail" type="mail" class="form-control" id="formGroupExampleInput2" placeholder="Email">
            </div>
            <div v-if="errors.email">
                <div v-for="error, index in errors.email" :key="index" class="alert alert-danger" role="alert">
                    {{error}}
                </div>
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">Messaggio</span>
                </div>
                <textarea v-model="userMessage" class="form-control" aria-label="With textarea"></textarea>
            </div>
            <div v-if="errors.message">
                <div v-for="error, index in errors.message" :key="index" class="mt-2 alert alert-danger" role="alert">
                    {{error}}
                </div>
            </div>

            <button class="btn-dark mt-2" :disabled="sending">INVIA</button>
        </form>
    </div>
</template>

<script>
import Axios from 'axios';

export default {
    name: 'contact',
    data() {
        return {
            userName: '',
            userEmail: '',
            userMessage: '',
            success: false,
            errors: {},
            sending: false
        }
    },
    methods: {
        sendMessage() {
            this.sending = true;
            this.errors = {};

            axios.post('/api/leads', {
                name: this.userName,
                email: this.userEmail,
                message: this.userMessage
            })
            .then((response) => {
                if(response.data.success) {
                    this.success = true;

                    this.userName = '',
                    this.userEmail = '',
                    this.userMessage = ''
                } else {
                    this.errors = response.data.errors
                }
                this.sending = false
            });
        }
    }
}
</script>