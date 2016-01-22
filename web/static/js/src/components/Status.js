import React, { PropTypes } from 'react';
import classNames from 'classnames';
import camelcase from 'camelcase';


const propTypes = {
    name: PropTypes.string.isRequired,
    stateText: PropTypes.string.isRequired,
    targetUrl: PropTypes.string.isRequired,
};

const Status = (props) => {
    const { name, stateText, targetUrl } = props;
    const id = camelcase(name);
    const classes = classNames({
        'db-status': true,
        ['db-status--' + stateText]: true
    });
    let icon;
    let logo;

    if (/(failure|error)/.test(stateText)) {
        icon = '✖';
    } else if (stateText === 'success') {
        icon = '✓'
    } else if (stateText === 'pending') {
        icon = '–';
    }

    if (id === 'circleCi') {
        logo = <img src="/static/images/circleCi.svg" width="73" height="17" style={{ padding: '1px' }} />;
    } else if (id === 'travisCi') {
        logo = <img src="/static/images/travisCi.png" width="78" height="17" />;
    } else if (id === 'shippable') {
        logo = <img src="/static/images/shippable.png" width="65" height="17" />;
    } else if (id === 'scrutinizer') {
        logo = <img src="/static/images/scrutinizer.png" width="76" height="17" />;
    } else if (id === 'coveralls') {
        logo = <img src="/static/images/coveralls.svg" width="75" height="17" style={{ padding: '2px' }} />;
    } else {
        logo = name;
    }

    return (
        <a
            className={classes}
            href={targetUrl}
            target="_blank"
        >
            <span className="db-status__icon">{icon}</span><span className="db-status__text">{logo}</span>
        </a>
    );
};

Status.propTypes = propTypes;

export default Status;
