<template>
    <div>
        <div class="container-fluid">
            <div class="img-bg">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 d-flex justify-content-center align-items-center flex-wrap">
                        <h1 class="text-center py-5">
                            Encontre os melhores quartos e apartamentos, seja para alugar ou dividir <span class="my-2"><img src="https://www.webquarto.com.br/images/logo_medio.png" alt="" srcset="" height="50"></span>
                        </h1>
                        <div class="form-group d-flex w-md-50">
                          <input type="text" name="" id="" class="form-control" placeholder="Digite a cidade ou estado" aria-describedby="helpId">
                          <button class="btn">Procurar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'banner',
        data() {
            return {

            }
        },
    }
</script>

<style lang="scss" scoped>
    .container-fluid{
        background-color: rgb(247, 247, 247);
        .img-bg{
            background: url('https://www.webquarto.com.br/images/bg_pesquisa_png.png') no-repeat;
            background-position: bottom;
            background-size: contain;
            padding: 10rem 0;
            h1{
                font-family: 'Hind', sans-serif;
                color: rgb(94, 94, 94);
                font-weight: 600;
            }
            .w-md-50{
                width: 50%;
                .btn{
                    border: 1px solid rgb(94, 94, 94);
                    border-radius: 4px;
                    margin-left: 10px;
                    background: rgb(212, 212, 212);
                }
            }
        }
    }
    @media screen and (max-width: 785px) {
        .w-md-50{
            width: 100% !important;
        }
    }
</style>
