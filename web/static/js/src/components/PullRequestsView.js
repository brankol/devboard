import React, { Component, PropTypes } from 'react';
import axios from 'axios';
import PullRequest from './PullRequest';


class PullRequestsView extends Component {
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
            .get('/my/api/gh/v1/pull-requests/open?hours=1')
            .then(response => {
                console.log('PRs', response.data);
                this.setState({ data: response.data });
            })
            .catch(function (response) {
                console.error(response);
            });
    }

    render() {
        let noDataMsg;

        if (!this.state.data.length) {
            noDataMsg = <p>No recent activity in your pull requests</p>;
        }

        return (
            <div>
                <h2 className="h3">Pull requests</h2>
                <br />
                <div className="db-list">
                    {this.state.data.map(pr => {
                        return <PullRequest {...pr} key={pr.title + pr.updatedAt.date} />
                    })}
                </div>
                {noDataMsg}
            </div>
        );
    }
}

export default PullRequestsView;
