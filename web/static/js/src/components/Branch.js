import React, { PropTypes } from 'react';
import moment from 'moment';
import Status from './Status';


const propTypes = {
    lastCommit: PropTypes.object.isRequired,
    name: PropTypes.string.isRequired,
    repo: PropTypes.object.isRequired,
    updatedAt: PropTypes.object.isRequired,
};

const Branch = (props) => {
    const { lastCommit, name, repo, updatedAt } = props;

    return (
        <div className="db-branch">
            <div className="db-branch__hd row">
                <div className="db-branch__title col-lg-8">
                    <strong>{repo.owner + '/' + repo.name}</strong> in <code>{name}</code>
                </div>
                <div className="db-branch__time col-lg-4">
                    {moment(updatedAt.date, 'YYYY-MM-DD HH:mm:ss').fromNow()}
                </div>
            </div>
            <div className="db-branch__bd">
                {lastCommit.message}
            </div>
            <div className="db-branch__ft">
                {lastCommit.statuses.map(status => {
                    return <Status {...status} key={status.name} />
                })}
            </div>
        </div>
    );
};

Branch.propTypes = propTypes;

export default Branch;
