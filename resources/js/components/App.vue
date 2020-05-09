<template>
    <div>
        <b-button variant="outline-primary" @click="openModal('#create_order')">Crear Registro</b-button>
        <CreateOrder/>
        <v-client-table :data="rows" :columns="columns" :options="{ headings }"></v-client-table>
    </div>
</template>
<script>
import CreateOrder from './CreateOrder';
export default {
    components: { CreateOrder },
    data() {
        return {
            rows: [],
            columns: [
                'id',
                'user.name',
                'city.name',
                'status.name',
                'subtotal',
                'tax',
                'total',
                'comments',
                'shipping_value'
            ],
            headings: {
                'id': 'id',
                'user.name': 'Cliente',
                'city.name': 'Ciudad',
                'status.name': 'Estado',
                'subtotal': 'subtotal',
                'tax': 'Impuesto',
                'total': 'Total',
                'comments': 'Comentarios',
                'shipping_value': 'Valor Envio'
            }
        }
    },
    mounted() {
        this.getOrders();
    },
    methods: {
        getOrders(){
            axios.get('/api/orders/getOrders')
            .then(res => {
                this.rows = res.data.data;
            }).catch(err => {
                console.log(err);
            })
        },

        openModal(id, data = null){
            $(id).modal('show')
        }
    }
    
}
</script>