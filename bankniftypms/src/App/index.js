import React, { useEffect } from "react"
import { connect } from "react-redux"
import * as settingActions from "../actions/settingActions"
import { bindActionCreators } from "redux"
import ScrollToTop from "../Component/ScrollToTop"
import Loading from "../Component/Loader"
import Page from "../Pages"
import "./../assets/css/style.css"
import "./../assets/css/media.css"
import "bootstrap/dist/css/bootstrap.min.css"
import "@fortawesome/fontawesome-free/css/all.css"

const App = (props) => {
  const { isFetching, actions } = props
  useEffect(() => {
    const fetchData = () => {
      actions.getSettingData()
    }
    fetchData()
  }, [actions])
  return (
    <>
      {isFetching && <Loading />}
      <ScrollToTop />
      <Page />
    </>
  )
}

function mapStateToProps(state) {
  return {
    isFetching: state.isFetching,
  }
}

function mapDispatchToProps(dispatch) {
  return {
    actions: bindActionCreators(Object.assign(settingActions), dispatch),
  }
}

export default connect(mapStateToProps, mapDispatchToProps)(App)
