<template>
    <div>
        <div class="modal fade" id="create_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Orden</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <b-form>
                            <b-form-group label="Selecciona El Usuario">
                                <v-select :options="users" label="name" v-model="order.user"></v-select>
                            </b-form-group>
                            <b-form-group label="Selecciona La Ciudad">
                                <v-select :options="cities" label="name" v-model="order.city"></v-select>
                            </b-form-group>
                            <b-form-group label="Selecciona El Tus Productos">
                                <v-select v-model="order.products" @input="addOrderProducts" :options="products" label="name"></v-select>
                            </b-form-group>
                            <b-row v-if="order.orderProducts.length > 0">
                                <b-col md="12" class="pre-scrollable">

                                </b-col>
                            </b-row>
                            <b-form-group label="Porcentaje del impuesto">
                                <b-form-input v-model="order.tax" type="number" required placeholder="Ingresa el valor del impuesto"></b-form-input>
                            </b-form-group>
                            <h5>Subtotal: {{Subtotal}}</h5>
                            <h5>Valor Envio: {{ order.city.shipping_value }}</h5>
                            <h5>Valor Impuesto: {{ order.tax }} %</h5>
                            <h4>Total: {{ FinalTotal }}</h4>
                        </b-form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" @click="saveOrder" class="btn btn-primary">Save changes</button>
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
            order: {
                user: '',
                orderProducts: [],
                city: ''
            },
            users: [],
            cities: [],
            products: [],
            infoCustomer: [],
            subtotal: false,
            total: false,
        }
    },
    mounted() {
        this.getUsers();
        this.getCities();
        this.getProduct();
    },
    methods: {
        getUsers(){
            axios.get('/api/orders/getUsers')
            .then(res => {
                this.users = res.data.data
            }).catch(err => {
                console.log(err)
            })
        },

        getCities(){
            axios.get('/api/orders/getCities')
            .then(res => {
                this.cities = res.data.data
            }).catch(err => {
                console.log(err)
            })
        },

        getProduct(){
            axios.get('/api/orders/getProducts')
            .then(res => {
                this.products = res.data.data
            }).catch(err => {
                console.log(err)
            })
        },

        addOrderProducts(){
            var filter = this.order.orderProducts.filter( item => item.id == this.order.products.id )
            if(filter.length == 0){
                this.order.orderProducts.push({ product: this.order.products, quantity: 1 })
            }else{
                alert(filter)
            }
            this.order.OrderDetail = null        
            this.subtotal = true
        },

        upQuantity(id){
            console.log(id)
            this.order.orderProducts.forEach(item => {
                if(item.product.id == id){
                    item.quantity++
                }
            })

            this.subtotal = true
        },

        downQuantity(id){
            this.order.orderProducts.forEach(item => {
                if(item.product.id == id){
                    item.quantity--
                }
            })

            this.subtotal = true
        },

        saveOrder(){
            let data = new FormData()
            for (const key in this.order) {
                if (key == "user") {
                    data.append('user',this.order.user.id)
                }else if(key == "city"){
                    data.append('city', this.order.city.id)
                }else if(key == "orderProducts"){
                    data.append('products',JSON.stringify(this.order.orderProducts))
                }else if(key == "comment"){
                    data.append(key,this.order[key])
                }else if(key == "tax"){
                    data.append(key,this.order[key])
                }else if(key == "subtotal"){
                    data.append(key,this.order[key])
                }else if(key == "total"){
                    data.append(key,this.order[key])
                }else if(key == "shipping_value"){
                    data.append(key,this.order.city.shipping_value)
                }
            }
            data.append('shipping_value', this.order.city.shipping_value)
            axios.post('/api/orders/saveOrder', data)
            .then(res => {
                if(res.data.code == 200){
                    console.log('se creo exitosamente la orden')
                    this.$emit('newOrder')
                    $('#create_order').modal('hide')
                }
            }).catch(err => {
                loader.hide()
                this.$swal({
                    icon: 'error',
                    text: 'No se pudo cargar los productos'
                })
            })
        }
    },
    watch: {
        order: {
            handler: function(){
                localStorage.setItem('orden', JSON.stringify(this.order))
                this.infoCustomer = [JSON.parse(localStorage.getItem('orden'))];
            },
            deep: true,
        }
    },

    computed: {
        Subtotal(){
            this.subtotal = false
            let option = 0
            this.infoCustomer.map(function(item){
                for(var i=0; i < item.orderProducts.length; i++){
                    if(item.orderProducts.length > 0){
                        let sale_price = item.orderProducts[i].product.sale_price
                        let quantity = item.orderProducts[i].quantity
                        option+=sale_price*quantity 
                    }
                }
            })
            this.order.subtotal = option
            return option
            this.total = true
        },

        FinalTotal(){
            this.total = false
            let total = 0
            let subtotal = this.order.subtotal
            let shipping_value = this.order.city.shipping_value
            let tax = this.order.tax
            total += subtotal + shipping_value + (subtotal * tax / 100)
            this.order.total = total
            return total            
        },
    },
}
</script>