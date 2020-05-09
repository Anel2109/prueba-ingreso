import axios from 'axios';

export default {
    getOrders(Context){
        return axios({
            url: '/api/orders/getOrders',
            type: 'GET',
        }).then(res => {
            Context.commit('CommitOrder', res.data.data);
        }).catch(err => {
            console.log(err);
        })
    }
};