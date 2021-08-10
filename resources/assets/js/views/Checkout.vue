<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="order-box">
                    <img :src="produto.image" :alt="produto.nome">
                    <h2 class="title" v-html="produto.nome"></h2>
                    <p class="small-text text-muted float-left">R$ {{produto.preco}}</p>
                    <p class="small-text text-muted float-right">Quantidade disponível: {{produto.unidades}}</p>
                    <br>
                    <hr>
                    <label class="row">
                        <span class="col-md-2 float-left">Quantidade: </span>
                        <input type="number" name="unidades" min="1" :max="produto.unidades" class="col-md-2 float-left" v-model="quantidade" @change="checkUnits">
                    </label>
                </div>
                <br>
                <div>
                    <div v-if="!isLoggedIn">
                        <h2>Você precisa fazer o login para continuar</h2>
                        <button class="col-md-4 btn btn-primary float-left" @click="login">Entrar</button>
                        <button class="col-md-4 btn btn-danger float-right" @click="register">Criar uma conta</button>
                    </div>
                    <div v-if="isLoggedIn">
                        <div class="row">
                            <label for="endereco" class="col-md-3 col-form-label">Endereço de Entrega</label>
                            <div class="col-md-9">
                                <input id="endereco" type="text" class="form-control" v-model="endereco" required>
                            </div>
                        </div>
                        <br>
                        <button class="col-md-4 btn btn-sm btn-success float-right" v-if="isLoggedIn" @click="facaPedido">Continuar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['pid'],
    data() {
        return {
            endereco: "",
            quntidade: 1,
            isLoggedIn: null,
            produto: []
        }
    },

    mounted() {
        this.isLoggedIn = localStorage.getItem('jwt') != null
    },

    beforeMount() {
        axios.get('/api/produtos/${this.pid}')
             .then(response => {
                 this.produto = response.data
             })
             .catch(error => {
                 console.error(error);
             })

             if (localStorage.getItem('jwt') != null) {
                 this.user = JSON.parse(localStorage.getItem('user'))
                 axios.defaults.headers.common['Content-Type'] = 'application/json'
                 axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('jwt')
             }
    },

    methods: {
        login() {
            this.$router.push({name: 'login', params: { nextUrl: this.$route.fullPath}})
        },

        register() {
            this.$router.push({ name: 'register', params: { nextUrl: this.$route.fullPath}})
        }
    },

    facaPedido(e) {
        e.preventDefault()
        axios.post('api/pedido/', {
            endereco: this.endereco,
            quantidade: this.quantidade,
            produto: this.produto.id
        })
        .then(response => {
            this.$router.push('/confirmation')
        })
        .catch(error => {
            console.error(error);
        })
    },

    checkUnits(e) {
        if (this.quantidade > this.produto.unidades) {
            this.quantidade = this.produto.unidades
        }
    }
}
</script>
<style scoped>
    .small-text {
        font-size: 18px;
    }
    .order-box {
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }

    .title {
        font-size: 36px;
    }
</style>