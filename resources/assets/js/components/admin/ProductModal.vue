<template>
    <div>
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-header">
                        <slot name="header" v-html="data.name">

                        </slot>
                    </div>
                    <div class="modal-body">
                        <slot name="body">
                            Nome: <input type="text" v-model="data.nome">
                            Unidades: <input type="text" v-model="data.unidades">
                            Preço: <input type="text" v-model="data.preco">
                            <textarea v-model="data.descricao" placeholder="descrição"></textarea>
                            <span>
                                <img :src="data.image" v-show="data.image" != null>
                                <input  type="file" id="file" @change="attachFile">
                            </span>
                        </slot>
                    </div>
                    <div class="modal-footer">
                        <slot name="footer">
                            <button class="modal-default-button" @click="uploadFile">
                                Finalizar
                            </button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['produto'],
    data() {
        return {
            attachment: null
        }
    },

    computed: {
        data: function() {
            if (this.produto != null) {
                return this.produto
            } else {
                return {
                    nome: "",
                    unidades: "",
                    preco: "",
                    descricao: "",
                    image: false
                }
            }
        }
    },

    methods: {
        attachFile(event) {
            this.attachFile = event.target.files[0];
        },

        uploadFile(event) {
            if (this.attachment != null) {
                var formData = new FormData();
                formData.append("image", this.attachment)
                axios.post("/api/upload-file", formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.produto.image = response.data
                    this.$emit('close', this.produto)
                })
            } else {
                this.$emit('close', this.produto)
            }
        }
    }
}
</script>
<style lang="">
    
</style>