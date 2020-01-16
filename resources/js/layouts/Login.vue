<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Login
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
                      <label for="">Email</label>
                      <input type="email" class="form-control" name="" id="" aria-describedby="helpId" placeholder="" v-model="email">
                    </div>
                    <div class="form-group">
                        <label for="">Senha</label>
                        <input id="" class="form-control" type="password" name="" v-model="password">
                    </div>
                    <button class="btn">
                        Entrar
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'login',
    props: ['app'],
    data(){
        return {
            email: '',
            password: '',
            errors: []
        }
    },
    methods: {
        onSubmit(){
            // console.log(this.app);
            this.errors = [];
            if(!this.email){
                this.errors.push('Por favor, informe um nome.');
            }
            if(!this.password){
                this.errors.push('Por favor, informe uma senha.')
            }
            if(!this.errors.length){
                const data = {
                    email: this.email,
                    password: this.password
                }

                axios.post('auth/login', data).then(response => {
                    this.app.user = response.data;
                    this.$router.push('/');
                }).catch(error => {
                    this.errors.push(error.response.data.error);
                });

            }else{
                console.log(this.errors)
            }
        }
    },
}
</script>

<style lang="scss" scoped>
    .container{
        height: 100%;
        display: flex;
        flex: 1;
        justify-content: center;
        align-items: center;
        .card{
            width: 40%;
        }
    }
</style>
