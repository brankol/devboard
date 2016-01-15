import React from 'react';
import { render } from 'react-dom';
import BranchesView from './components/BranchesView';


render(
    <div className="container">
        <div className="row">
            <div className="col-sm-6">
                <BranchesView />
            </div>
            <div className="col-sm-6">
                <h2 className="h3">Pull requests</h2>
                <p>todo</p>
            </div>
        </div>
    </div>,
    document.getElementById('app')
);
