import React from 'react';
import { render } from 'react-dom';
import axios from 'axios';

function getData() {
    return axios
        .get('/my/api/gh/v1/branches/live?hours=30')
        .then(function (response) {
            console.log('branches', response.data);
        })
        .catch(function (response) {
            console.error(response);
        });
}
window.setInterval(getData, 10000);

render(
    <h1>Hello world</h1>,
    document.getElementById('app')
);
