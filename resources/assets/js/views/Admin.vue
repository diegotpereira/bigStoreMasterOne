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
import Products from '../components/admin/Products'
import Pedidos from '../components/admin/Pedidos'

export default {
    data() {
        return {
            
        }
    },
}
</script>
<style lang="">
    
</style>