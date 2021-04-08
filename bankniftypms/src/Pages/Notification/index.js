import React, { lazy, useEffect } from "react"
import { Row, Col, Card } from "react-bootstrap"
import { useDispatch, useSelector } from "react-redux"
import {
  getNotificationData,
  clearNotification,
} from "../../actions/planActions"
import { checkConform } from "../../utils/helpers"
const Breadcrumb = lazy(() => import("../../Component/Breadcrumb"))

const Index = (props) => {
  const dispatch = useDispatch()
  const { notification } = useSelector((state) => ({
    notification: state.notification,
  }))
  useEffect(() => {
    const fetchData = () => {
      dispatch(getNotificationData())
    }
    fetchData()
  }, [dispatch])

  const handleClear = (e) => {
    e.preventDefault()
    const afterCallback = () => {
      dispatch(clearNotification())
    }
    checkConform(
      afterCallback,
      "Are you sure you want to clear all notification?"
    )
  }

  return (
    <>
      <Breadcrumb {...props} />
      <section className="dashboard_content_main dashbaord_home_dashboard">
        <Row className="m-0 p-0">
          <Col lg={12} className="">
            <div>
              <h3 className="ml-2">Notification</h3>
            </div>
            <div
              className="text-right button_link"
              onClick={(e) => handleClear(e)}
            >
              Clear All
            </div>
          </Col>

          <Col lg={12} className="mt-md-4">
            {notification.length > 0 ? (
              <>
                {notification.map((item, key) => (
                  <Card key={key} className="m-2">
                    <Card.Body>
                      <Card.Title>
                        <b>{item.title}</b>
                      </Card.Title>
                      <Card.Subtitle className="mb-2 text-muted pt-2">
                        {item.message}
                      </Card.Subtitle>
                      <Card.Text className="text-right">{item.date}</Card.Text>
                    </Card.Body>
                  </Card>
                ))}
              </>
            ) : (
              <div className="text-center pt-5">
                <img
                  src="../assets/img/bell.svg"
                  key={1}
                  alt="no_image"
                  width="150"
                />
                <div className="pt-3">
                  Sorry you don't have received any notification
                </div>
              </div>
            )}
          </Col>
        </Row>
      </section>
    </>
  )
}

export default Index
