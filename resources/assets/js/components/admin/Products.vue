<template>
    <div>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td></td>
                    <td>Produto</td>
                    <td>Unidades</td>
                    <td>Preço</td>
                    <td>Descrição</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(produto,index) in produtos" :key="index" @dblclick="editingitem=produto">
                    <td>{{index + 1 }}</td>
                    <td v-html="produto.nome"></td>
                    <td v-model="produto.unidades">{{produto.unidades}}</td>
                    <td v-model="produto.preco">{{produto.preco}}</td>
                    <td v-model="produto.descricao">{{produto.descricao}}</td>
                </tr>
            </tbody>
        </table>
        <modal @close="endEditing" :produto="editingItem" v-show="editingItem != null"></modal>
        <modal @close="addProduct" :produto="addingProduto" v-show="addingProduct != null"></modal>
        <br>
        <button class="btn btn-primary" @click="novoProduto">Novo Produto</button>
    </div>
</template>
<script>
import Modal from './ProductModal'
export default {
    data() {
        return {
            produtos: [],
            editingItem: null,
            addingProduct : null
        }
    },

    components: {
        Modal
    },

    beforeMount() {
        axios.get('/api/produtos/')
             .then( response => {
                 this.produtos = response.data
             })

             .catch(error => {
                 console.error(error);
             })
    },

    methods: {
        novoProduto() {
            this.addingProduct = {
                nome: null,
                unidades: null,
                preco: null,
                descricao: null,
                image: null
            }
        },

        endEditing(produto) {
            this.editingItem = null
            let index = this.produtos.indexOf(produto)
            axios.put(`/api/produtos/${produto.id}`, {
                nome: produto.nome,
                unidades: produto.unidades,
                preco: produto.preco,
                descricao: produto.descricao,
            })
            .then(response => {
                this.produtos[index] = produto
            })
            .catch(response => {

            })
        },

        addProduto(produto) {
            this.addingProduct = null
            axios.post("/api/produtos/", {
                nome: produto.nome,
                unidades: produto.unidade,
                preco: produto.preco,
                descricao: produto.descricao,
                image: produto.image
            })
            .then(response => {
                this.produtos.push(produto)
            })
            .catch(response => {

            })
        }
    }
}
</script>
<style lang="">
    
</style>