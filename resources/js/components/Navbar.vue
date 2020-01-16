<template>
  <div class="container">
      <nav class="navbar navbar-expand-md fixed-top">
          <router-link to="/" class="navbar-brand">
            <img src="https://www.webquarto.com.br/images/logo_medio.png" alt="" srcset="">
          </router-link>
          <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
              aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavId">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

              </ul>
              <form class="form-inline my-2 my-lg-0">
                  <div v-if="app.user" class="welcome-nav">
                    Bem vind@ {{ app.user.name }}
                  </div>
                  <div v-if="!app.user">
                    <router-link to="/login" class="btn">Login</router-link>
                    <router-link to="/register" class="btn">Registrar</router-link>
                  </div>
                  <div v-else>
                    <li class="nav-item dropdown mr-3">
                        <a class="btn dropdown-toggle" id="navbarDropdown" data-toggle="dropdown">
                        Conta
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <router-link to="/profile" class="dropdown-item">Minha Conta</router-link>
                            <div class="dropdown-divider"></div>
                            <a @click="logout" class="dropdown-item">Logout</a>
                        </div>
                    </li>
                  </div>
              </form>
          </div>
      </nav>
  </div>
</template>

<script>
export default {
    name: 'navbar',
    props: ['app'],
    data() {
        return {

        }
    },
    methods:{
        logout(){
            axios.post('/auth/logout').then(()=>{
                this.app.user = null;
                this.$router.push('/login');
            })
        }
    }
}
</script>

<style lang="scss" scoped>
    nav{
        font-family: 'Varela Round', sans-serif;
        background: rgb(255, 255, 255);
        color: rgb(49, 58, 70);
        font-size: 12px !important;
        outline-color: rgb(121, 121, 121);

        a.navbar-brand{
            text-decoration: none;
            img{
                height: 30px;
            }
        }
        .welcome-nav{
            margin-right: 10px;
        }

        li.nav-item{
            list-style-type: none;
        }
        .btn{
            color: rgb(49, 58, 70) !important;
            font-size: 14px !important;
        }
        span.navbar-toggler-icon{
            color: rgb(49, 58, 70);
        }

    }
</style>
