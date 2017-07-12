import React from 'react';
import {connect} from 'react-redux';
import CircularLoaderFull from '../components/CircularLoaderFull';
import MainPanel from './MainPanel';

// smart component with redux connect

const Base = ({init}) => (
    <div>
        {init ?
            <CircularLoaderFull /> : <MainPanel />
        }
    </div>
);

// map state
function mapStateTopProps(state) {
    return {
        init: state.settings.init
    }
}

// map dispatch
function mapDispatchToProps(dispatch) {
    return {}
}

// connect and export
export default connect(mapStateTopProps, mapDispatchToProps)(Base);
