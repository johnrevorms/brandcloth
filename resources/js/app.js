import './bootstrap';
import '../css/app.css';
import './navbar.js'; // efek scroll navbar
import axios from 'axios';

axios.get('/api/products')
    .then(res => console.log(res.data))
    .catch(err => console.error(err));
