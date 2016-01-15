import React, { PropTypes } from 'react';
import classNames from 'classnames';


const propTypes = {
    name: PropTypes.string.isRequired,
    stateText: PropTypes.string.isRequired,
    targetUrl: PropTypes.string.isRequired,
};

const Status = (props) => {
    const { name, stateText, targetUrl } = props;
    const classes = classNames({
        'db-status': true,
        ['db-status--' + stateText]: true
    });
    let icon;

    if (stateText === 'failure') {
        icon = '✖';
    } else if (stateText === 'success') {
        icon = '✓'
    } else if (stateText === 'pending') {
        icon = '–';
    }

    return (
        <a
            className={classes}
            href={targetUrl}
            target="_blank"
        >
            <span className="db-status__icon">{icon}</span><span className="db-status__text">{name}</span>
        </a>
    );
};

Status.propTypes = propTypes;

export default Status;
