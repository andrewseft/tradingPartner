import React, { useEffect, lazy } from "react"
import { useSelector, useDispatch } from "react-redux"
import { loadPageData } from "../../actions/homePageActions"
import { Container, Row, Col } from "react-bootstrap"
const Breadcrumb = lazy(() => import("../../Component/Breadcrumb"))

const Index = (props) => {
  const slug = props.location.pathname
  const dispatch = useDispatch()
  const { pageData } = useSelector((state) => ({
    pageData: state.pageData,
  }))

  const prepareHtml = (description) => {
    if (description) {
      return { __html: description || "" }
    }
    return { __html: "" }
  }

  useEffect(() => {
    const fetchData = () => {
      dispatch(loadPageData(slug))
    }
    fetchData()
  }, [dispatch, slug])

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

export default Index
