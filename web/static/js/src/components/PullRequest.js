import React, { PropTypes } from 'react';
import moment from 'moment';
import Status from './Status';


const propTypes = {
    lastCommit: PropTypes.object.isRequired,
    title: PropTypes.string.isRequired,
    number: PropTypes.number.isRequired,
    repo: PropTypes.object.isRequired,
    updatedAt: PropTypes.object.isRequired,
};

const PullRequest = (props) => {
    const { lastCommit, title, number, repo, updatedAt } = props;

    return (
        <div className="db-item db-item--pr">
            <div className="db-item__hd row">
                <a className="db-item__title col-lg-8 clr-def" href={repo.htmlUrl} target="_blank">
                    <strong>{repo.owner + '/' + repo.name}</strong>
                </a>
                <div className="db-item__time col-lg-4">
                    {moment(updatedAt.date, 'YYYY-MM-DD HH:mm:ss').fromNow()}
                </div>
            </div>
            <div className="db-item__bd">
                <code>#{number}</code> <a href={repo.htmlUrl + '/pull/' + number} target="_blank">{title}</a>
            </div>
            <div className="db-item__ft">
                {lastCommit.statuses.map(status => {
                    return <Status {...status} key={status.name} />
                })}
            </div>
        </div>
    );
};

PullRequest.propTypes = propTypes;

export default PullRequest;
