<template>
    <div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td></td>
                    <td>Produto</td>
                    <td>Quantidade</td>
                    <td>Custo</td>
                    <td>Endereço de entrega</td>
                    <td>Entregue?</td>
                    <td>Ação</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(pedido, index) in pedidos" :key="index">
                    <td>{{index + 1}}</td>
                    <td v-html="pedido.produto.nome"></td>
                    <td>{{ pedido.quantidade}}</td>
                    <td>{{ pedido.quantidade * pedido.produto.nome}}</td>
                    <td>{{ pedido.endereco}}</td>
                    <td>{{ pedido.entregue == 1? "Sim" : "Não"}}</td>
                    <td v-if="pedido.entregue == 0">
                        <button class="btn btn-success" @click="entregar(index)">Entregar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    data() {
        return {
            pedidos: []
        }
    },

    beforeMount() {
        axios.get('/api/pedidos/')
             .then(response => {
                 this.pedidos = response.data
             })

             .catch(error => {
                 console.error(error);
             })
    },

    methods: {
        entregar(index) {
            let pedido = this.pedidos[index]
            axios.patch( `/api/pedidos/${pedido.id}/entregar` )
                 .then(response => {
                     this.pedidos[index].entregue = 1
                     this.$forceUpdate()
                 })
                 .catch(error => {
                     console.error(error);
                 })
        }
    }
}
</script>
<style lang="">
    
</style>