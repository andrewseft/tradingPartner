import React, { useEffect } from "react"
import { connect } from "react-redux"
import { bindActionCreators } from "redux"
import * as homePageActions from "../../actions/homePageActions"
import Faq from "../../Component/Page/faq"
import Breadcrumb from "../../Component/Breadcrumb"

const Index = (props) => {
  const { actions, homePageData } = props

  useEffect(() => {
    const fetchData = () => {
      actions.loadHomePageData("index")
    }
    fetchData()
  }, [actions])

  return (
    <div className="pt-5">
      <Breadcrumb {...props} />
      <Faq homePageData={homePageData} />
    </div>
  )
}

function mapStateToProps(state) {
  return {
    homePageData: state.homePageData,
  }
}

function mapDispatchToProps(dispatch) {
  return {
    actions: bindActionCreators(Object.assign(homePageActions), dispatch),
  }
}

export default connect(mapStateToProps, mapDispatchToProps)(Index)
