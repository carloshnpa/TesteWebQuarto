<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="card">
                    <div class="card-header">
                        {{ this.app.user.name }}
                    </div>
                    <div class="card-body">
                        <h4 class="card-text">Email:<br> {{ this.app.user.email }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-8">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab">Perfil</a>
                    </li>
                    <li class="nav-item" v-for="(imovel, index) in this.property" :key="index">
                        <a class="nav-link" v-bind:id="'tab-' + index" data-toggle="tab" v-bind:href="'#rent-' + index" role="tab" >Imóvel {{index + 1}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#add" role="tab">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Imóvel
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane bg-white fade show active" id="profile" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <form v-on:submit.prevent="saveProfile" class="m-3 m-md-5">
                                    <div class="form-group">
                                      <label for="">Nome</label>
                                      <input type="text" name="" class="form-control" v-model="this.name">
                                    </div>
                                    <div class="form-group">
                                      <label for="">Email</label>
                                      <input type="text" name="" class="form-control" v-model="this.email">
                                    </div>
                                    <div class="form-group">
                                      <label for="">Senha</label>
                                      <input type="password" name="" class="form-control" v-model="password">
                                    </div>
                                    <div class="form-group d-flex justify-content-end">
                                        <button class="btn">
                                            Salvar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" v-for="(imovel, index) in this.property" :key="index" v-bind:id="'rent-' +index" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <card
                                    :key="index"
                                    :value="imovel.value"
                                    :img="imovel.photo"
                                    :title="imovel.title"
                                    :id="imovel.id"
                                    :city="imovel.city"
                                    :state="imovel.state"
                                    :img_h="img_height"
                                    :edit="true"
                                    class="m-3 m-md-5"
                                />
                                <div class="d-flex align-items-center justify-content-between">
                                    <button class="btn mx-auto btn-danger" @click="deleteImovel(imovel.id)">
                                        Excluir
                                    </button>
                                    <button class="btn mx-auto" @click="editImovel(imovel)">
                                        Editar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane bg-white fade show" id="add" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <div v-if="this.errors.length" class="alert alert-danger">
                                    <ul class="mb-0">
                                        <li v-for="(error, index) in this.errors" :key="index" class="list-item">
                                            {{ error }}
                                        </li>
                                    </ul>
                                </div>
                                <form v-on:submit.prevent="saveImovel" class="m-3 m-md-5">
                                    <div class="form-group">
                                      <input type="text" name="" class="form-control" placeholder="Titulo" v-model="title" required>
                                    </div>
                                    <div class="form-group">
                                      <input type="text" name="" class="form-control" placeholder="Valor" v-model="value" required>
                                    </div>
                                    <div class="form-group">
                                      <textarea class="form-control" placeholder="Descrição" v-model="description" rows="4" required>
                                      </textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" v-on:change="onImageChange" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="" class="form-control" placeholder="CEP" v-model="postal_code" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="" class="form-control" placeholder="Rua" v-model="street" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="" class="form-control" placeholder="Numero" v-model="number" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="" class="form-control" placeholder="Complemento" v-model="complement">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="" class="form-control" placeholder="Cidade" v-model="city" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="" class="form-control" placeholder="Estado" v-model="state" required>
                                    </div>
                                    <div class="form-group d-flex justify-content-end">
                                        <button class="btn">
                                            Salvar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Card from '../components/Card';
    export default {
        name: 'profile',
        props: ['app'],
        components:{
            Card
        },
        mounted(){
            this.checkLogin();
            this.getProperties();
        },
        data() {
            return {
                name: '',
                id: '',
                email: '',
                property: [],
                img_height: 450,
                password: '',
                title: '',
                value: '',
                description: '',
                postal_code: '',
                street: '',
                number: '',
                complement: '',
                city: '',
                state: '',
                photo: '',
                errors: [],
                save: false,

            }
        },

        methods:{
            async saveProfile(){
                this.errors = []
                var data = {
                    id: this.app.user.id,
                    name: this.name,
                    email: this.email,
                    password: this.password
                }
                axios.put(`/user/edit/${this.app.user.id}`, data).then(response => {
                    this.app.user = response.data
                }).catch(error => {
                    this.errors.push(error)
                })
            },
            onImageChange(e){
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.photo = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            async deleteImovel(id){
                this.errors = []
                axios.delete(`/property/${id}`).then(response => {
                    console.log(response)
                }).catch(error=>{
                    // this.errors.push(error)
                })

                this.getProperties();
            },
            async saveImovel(){
                this.errors = []
                this.save = true;

                if(!this.errors.length){
                    var data = {
                        title: this.title,
                        value: this.value,
                        description: this.description,
                        postal_code: this.postal_code,
                        street: this.street,
                        number: this.number,
                        complement: this.complement,
                        city: this.city,
                        state: this.state,
                        photo: this.photo,
                        user_id : this.app.user.id
                    }
                    axios.post('/property', data).then(response => {
                        this.getProperties();
                    }).catch(error => {
                        this.errors.push(error)
                    })

                }
            },
            async editImovel(imovel){
                this.errors = []
                console.log(imovel);
            },
            async getProperties(){
                this.property = []
                var data = {
                    id_user: this.app.user.id
                };
                axios.post('property/user', data)
                    .then(response => {
                        this.property = response.data.properties
                    }).catch(error => {
                        console.log(error)
                    });
            },
            async checkLogin(){
                if(!this.app.user){
                    this.$router.push('/')
                }else{
                    this.name = this.app.user.name,
                    this.id = this.app.user.id,
                    this.email = this.app.user.email
                }
            }
        },
    }
</script>

<style lang="scss" scoped>
    .container-fluid{
        background: rgb(247, 247, 247);
        padding: 3rem;
        font-family: 'Hind';
        .nav-link{
            color: #55748f;
            &:hover{
                color: #52d298;
            }
            &.active{
                border-color: #55748f;
                border-bottom-color: transparent;
            }
        }
        .tab-content{
            border-color: #55748f;
            .tab-pane{
                background-color: white;
                border: 1px #55748f solid;
                border-top: 0;
            }
        }

        .btn{
            background-color: #52d298;
            color: white;
            margin: 10px 0;
        }

        .card{
            color: rgb(49, 58, 70);
            border: none;
            border-radius: 0;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            .card-header{
                background-color: #55748f;
                color: white;
                font-size: 24px;
            }
            h4.card-text{
                font-size: 16px;
            }
        }
    }
</style>
