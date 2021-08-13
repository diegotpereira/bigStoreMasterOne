<template>
    <div>
        <div class="container-fluid hero-section d-flex align-content-center justify-content-center flex-wrap ml-auto">
            <h2 class="title">Seus Pedidos</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="row">
                        <div class="col-md-4 product-box" v-for="(pedido, index) in pedidos.data" :key="index">
                            <img :src="pedido.produto.image" :alt="pedido.produto.nome">
                            <h5><span  v-html="pedido.produto.nome"></span><br>
                                <span class="small-text text-muted">R$ {{pedido.produto.preco}}</span>
                            </h5>
                            <hr>
                            <span class="small-text text-muted">Quantidade: {{pedido.quantidade}}
                                <span class="float-right">{{pedido.entregue == 1 ? "enviado!" : "não enviado"}}</span>
                            </span>
                            <br><br>
                            <p><strong>Endereço de entrega: </strong> <br>{{pedido.endereco}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user: null,
            pedidos: [],            
        }
    },

    // computed: {
    //     produto() {
    //         return this.$store.getters.produto;
    //     }
    // },
    
    beforeMount() {
        this.user = JSON.parse(localStorage.getItem('user'))
        axios.defaults.headers.common['Content-Type'] = 'application/json'
        axios.defaults.headers.common['Authorization'] = 'Bearer' + localStorage.getItem('jwt')

        axios.get('api/users' + this.user.id + '/pedidos')
        // axios.get(`api/users/${this.user.id}/pedidos`)   
        
             .then(response => {
                 this.pedidos = response.data
                //  this.produto = response.data
             })

             .catch(error => {
                 console.error(error);
             })
    }
    
}
</script>
<style scoped>
  .small-text {
      font-size: 14px;
  }

  .product-box {
      border: 1px solid #cccccc;
      padding: 10px 15px;
  }

  .hero-section {
      height: 20vh;
      background: #ababab;
      align-items: center;
      margin-bottom: 20px;
      margin-top: -20px;
  }

  .title {
      font-size: 60px;
      color: #ffffff;
  }
</style>