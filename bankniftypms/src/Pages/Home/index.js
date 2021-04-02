import React, { useEffect } from "react"
import { connect } from "react-redux"
import { bindActionCreators } from "redux"
import * as homePageActions from "../../actions/homePageActions"

import Home from "../../Component/Page/home"
import Offer from "../../Component/Page/offer"
import Features from "../../Component/Page/features"
import About from "../../Component/Page/about"

const Index = (props) => {
  const { title, location, actions, homePageData } = props

  useEffect(() => {
    document.title = title
    var id = location.pathname.replace("/", "")
    var position = document.getElementById(id.trim())
    if (position) {
      position.scrollIntoView({ behavior: "smooth" })
    }
  }, [title, location])

  useEffect(() => {
    const fetchData = () => {
      actions.loadHomePageData("index")
    }
    fetchData()
  }, [actions])

  return (
    <>
      <Home />
      <Offer homePageData={homePageData} />
      <About homePageData={homePageData} />
      <Features homePageData={homePageData} />
    </>
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
