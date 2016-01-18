import React from 'react';
import { render } from 'react-dom';
import BranchesView from './components/BranchesView';
import PullRequestsView from './components/PullRequestsView';


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
