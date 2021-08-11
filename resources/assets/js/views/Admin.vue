<template>
    <div>
        <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class="title">Admin Dashboard</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <ul style="list-style-type:none">
                        <li class="active"><button class="btn" @click="setComponent('main')">Painel</button></li>
                        <li><button class="btn" @click="setComponent('pedidos')">Pedidos</button></li>
                        <li><button class="btn" @click="setComponent('produtos')">Produtos</button></li>
                        <li><button class="btn" @click="setComponent('users')">Usuários</button></li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <component :is="activeComponent"></component>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Main from '../components/admin/Main'
import Users from '../components/admin/Users'
import Produtos from '../components/admin/Products'
import Pedidos from '../components/admin/Pedidos'

export default {
    data() {
        return {
            user : null,
            activeComponent : null
        }
    },

    components: {
        Main, Users, Produtos, Pedidos
    },

    beforeMount() {
        this.setComponent(this.$route.params.page)
        this.user = JSON.parse(localStorage.getItem('user'))
        axios.defaults.headers.common['Content-Type'] = 'application/json'
        axios.defaults.headers.common['Authorization'] = 'Bearer' + localStorage.getItem('jwt')
    },

    methods: {
        setComponent(value) {
            switch(value) {
                case "users": 
                     this.activeComponent = Users 
                     this.$router.push({name : 'admin-pages', params : {page: 'users'}})
                     break;
                 case "pedidos":
                     this.activeComponent = pedidos 
                     this.$router.push({name : 'admin-pages', params : {page: 'pedidos'}}) 
                     break;
                  case "produtos":
                      this.activeComponent = Produtos 
                      this.$router.push({name : 'admin-pages', params : {page : 'produtos'}})
                      break;
                  default:
                      this.activeComponent = Main 
                      this.$router.push({ name : 'admin'})    
                      break;
            }
        }
    }
}
</script>
<style lang="">
    
</style>