import React, { Component, PropTypes } from 'react';
import axios from 'axios';
import Branch from './Branch';


class BranchesView extends Component {
    constructor(props) {
        super(props);
        this.state = { data: [] };
    }

    componentWillMount() {
        this.getData();
        window.setInterval(this.getData.bind(this), 10000);
    }

    getData() {
        return axios
            .get('/my/api/gh/v1/branches/live?hours=150')
            .then(response => {
                console.log('branches', response.data);
                this.setState({ data: response.data });
            })
            .catch(function (response) {
                console.error(response);
            });
    }

    render() {
        let noDataMsg;

        if (!this.state.data.length) {
            noDataMsg = <p>No recent activity in your branches</p>;
        }

        return (
            <div>
                <h2 className="h3">Branches</h2>
                <br />
                <div className="db-list">
                    {this.state.data.map(branch => {
                        return <Branch {...branch} key={branch.name + branch.updatedAt.date} />
                    })}
                </div>
                {noDataMsg}
            </div>
        );
    }
}

export default BranchesView;
