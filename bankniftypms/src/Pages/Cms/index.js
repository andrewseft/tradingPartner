import React, { useEffect } from "react"
import { connect } from "react-redux"
import { bindActionCreators } from "redux"
import * as homePageActions from "../../actions/homePageActions"
import Breadcrumb from "../../Component/Breadcrumb"
import { Container, Row, Col } from "react-bootstrap"

const Index = (props) => {
  const { actions, pageData } = props
  const slug = props.location.pathname

  const prepareHtml = (description) => {
    if (description) {
      return { __html: description || "" }
    }
    return { __html: "" }
  }

  useEffect(() => {
    const fetchData = () => {
      actions.loadPageData(slug)
    }
    fetchData()
  }, [actions, slug])

  return (
    <>
      <Breadcrumb {...props} />
      <section className="mt-md-5 privacy_sec">
        <Container>
          <div class="heading_sec text-center mb-md-4">
            <h2>{pageData.title}</h2>
            <div className="bar"></div>
          </div>
          <Row>
            <Col lg={12}>
              <div
                dangerouslySetInnerHTML={prepareHtml(pageData.description)}
              ></div>
            </Col>
          </Row>
        </Container>
      </section>
    </>
  )
}

function mapStateToProps(state) {
  return {
    pageData: state.pageData,
  }
}

function mapDispatchToProps(dispatch) {
  return {
    actions: bindActionCreators(Object.assign(homePageActions), dispatch),
  }
}

export default connect(mapStateToProps, mapDispatchToProps)(Index)
