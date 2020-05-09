// import libraries
require('./bootstrap');
import BootstrapVue from "bootstrap-vue"
import vSelect from 'vue-select'
import { ClientTable,ServerTable, Event } from 'vue-tables-2';

// Window Vue
window.Vue = require('vue');

// Import Component
import App from './components/App';

// Import Styles
import 'vue-select/dist/vue-select.css';

// Vue Components
Vue.component('v-select', vSelect);

// Vue Use
Vue.use(BootstrapVue);
Vue.use(ClientTable, {
    perPage: 15,
    texts: {
        count: "Montrando del {from} al {to} de {count} Registros|{count} Registros|1 Registro",
        first: "First",
        last: "Last",
        filter: "",
        records:"......",
        filterPlaceholder: "Buscar registro",
        limit: "",
        page: "Page:",
        noResults: "Sin resultados",
        filterBy: "{column}",
        loading: "Cargando...",
        defaultOption: "Todas",
        columns: "Columns"
    }

});
Vue.use(ServerTable,{
    perPage: 15,
    texts: {
        count: "Montrando del {from} al {to} de {count} Registros|{count} Registros|1 Registro",
        first: "First",
        last: "Last",
        filter: "",
        records:"......",
        filterPlaceholder: "Buscar registro",
        limit: "",
        page: "Page:",
        noResults: "Sin resultados",
        filterBy: "{column}",
        loading: "Cargando...",
        defaultOption: "Todos",
        columns: "Columnas"
    }

});

// Import Styles
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap-vue/dist/bootstrap-vue.css";

// Constant
const app = new Vue({ el: '#app', components: { App } })