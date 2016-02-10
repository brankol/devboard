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
        <div className="db-item">
            <div className="db-item__inner">
                <div className="db-item__hd row">
                    <div className="db-item__title col-lg-8">
                        <strong><a href={repo.htmlUrl} target="_blank" className="clr-def">{repo.owner + '/' + repo.name}</a></strong> in <code>{name}</code>
                    </div>
                    <div className="db-item__time col-lg-4">
                        {moment.utc(updatedAt.date, 'YYYY-MM-DD HH:mm:ss').fromNow()}
                    </div>
                </div>
                <div className="db-item__bd">
                    {lastCommit.message}
                </div>
                <div className="db-item__ft">
                    {lastCommit.statuses.map(status => {
                        return <Status {...status} key={status.name} />
                    })}
                </div>
            </div>
        </div>
    );
};

Branch.propTypes = propTypes;

export default Branch;
