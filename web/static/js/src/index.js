import React from 'react';
import { render } from 'react-dom';
import promise from 'es6-promise';
import BranchesView from './components/BranchesView';
import PullRequestsView from './components/PullRequestsView';

promise.polyfill();

render(
    <div className="container">
        <div className="row">
            <div className="col-sm-6">
                <BranchesView />
            </div>
            <div className="col-sm-6">
                <PullRequestsView />
            </div>
        </div>
    </div>,
    document.getElementById('app')
);
