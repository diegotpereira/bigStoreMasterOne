<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <img :src="produto.image" :alt="produto.nome">
                <h3 class="title" v-html="produto.nome"></h3>
                <p class="text-muted">{{produto.descricao}}</p>
                <h4>
                    <span class="small-text text-muted float-left"> R$ {{produto.preco}}</span>
                    <span class="small-text float-right">Quantidade Disponível: {{produto.unidades}}</span>
                </h4>
                <br>
                <hr>
                <router-link :to="{path: '/checkout?pid='+produto.id}" class="col-md-4 btn btn-sm btn-primary float-right">Compre Agora</router-link>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            produto : []
        }
    },

    beforeMount() {
        axios.get(`/api/produtos/${this.$route.params.id}`)
             .then(response => {
                 this.produto = response.data
             })

             .catch(error => {
                 console.error(error);
             })
    }
}
</script>
<style scoped>
    .small-text {
        font-size: 18px;
    }
    .title {
        font-size: 36px;
    }
</style>