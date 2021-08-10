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
export default {
    
}
</script>
<style lang="">
    
</style>