<template>
    <div>
        <div class="container d-flex align-items-center justify-content-center mt-5">
            <div class="card">
                <div class="card-header">
                    Registrar
                </div>
                <div class="card-body">
                    <div v-if="this.errors.length" class="alert alert-danger">
                        <ul class="mb-0">
                            <li v-for="(error, index) in this.errors" :key="index" class="list-item">
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                    <form v-on:submit.prevent="onSubmit">
                        <div class="form-group">
                            <label for="">Nome</label>
                            <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="" v-model="name">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="" id="" aria-describedby="helpId" placeholder="" v-model="email">
                        </div>
                        <div class="form-group">
                            <label for="">Senha</label>
                            <input id="" class="form-control" type="password" name="" v-model="password">
                        </div>
                        <div class="form-group">
                            <label for="">Repetir Seha</label>
                            <input id="" class="form-control" type="password" name="" v-model="c_password">
                        </div>
                        <button class="btn">
                            Criar Conta
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'register',
        props: ['app'],
        data() {
            return {
                errors: [],
                email: '',
                name: '',
                password: '',
                c_password: ''
            }
        },
        methods: {
            onSubmit(){
                this.errors = []
                if(!this.email){
                    errors.push('Por favor, insira um email.');
                }
                if(!this.name){
                    errors.push('Por favor, informe um nome para cadastro.');
                }
                if(!this.password){
                    errors.push('Informe uma senha para acesso.')
                }
                if(!this.c_password){
                    errors.push('Repita a senha para confirmação.')
                }
                if(this.password !== this.c_password){
                    errors.push('As senhas devem ser iguais.')
                }

                if(!this.errors.length){
                    const data = {
                        name: this.name,
                        email: this.email,
                        password: this.password
                    }

                    axios.post('auth/register', data).then(response => {
                        this.app.user = response.data;
                        console.log(response);
                        this.$router.push('/');
                    }).catch(error => {
                        this.errors.push(error)
                    })
                }
            }
        }

    }
</script>

<style lang="scss" scoped>

</style>
