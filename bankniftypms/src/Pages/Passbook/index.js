import React, { lazy, useEffect } from "react"
import { Row, Col, Card } from "react-bootstrap"
import { useDispatch, useSelector } from "react-redux"
import { NavLink } from "react-router-dom"
import { getPassbookData } from "../../actions/planActions"

const Breadcrumb = lazy(() => import("../../Component/Breadcrumb"))

const Index = (props) => {
  const dispatch = useDispatch()
  const { passbook } = useSelector((state) => ({
    passbook: state.passbook,
  }))
  useEffect(() => {
    const fetchData = () => {
      dispatch(getPassbookData())
    }
    fetchData()
  }, [dispatch])

  return (
    <>
      <Breadcrumb {...props} />
      <section className="dashboard_content_main dashbaord_home_dashboard">
        <Row className="m-0 p-0">
          <Col lg={12} className="">
            <div>
              <h3 className="ml-2">My Passbook</h3>
            </div>
          </Col>

          <Col lg={12} className="mt-md-4">
            {passbook.length > 0 ? (
              <>
                {passbook.map((item) =>
                  item.transactions.map((book, key) => (
                    <Card
                      border={
                        book.type === "Debit" ? "danger m-2" : "success m-2"
                      }
                      key={key}
                    >
                      <Card.Body>
                        <Card.Title>{book.remark}</Card.Title>
                        <Card.Subtitle className="mb-2 text-muted">
                          <Row>
                            <Col sm={3} className="my-1">
                              {book.date}
                            </Col>
                            <Col sm={3} className="my-1">
                              <b>{book.amount}</b>
                            </Col>
                            <Col sm={3} className="my-1">
                              {book.type}
                            </Col>
                            <Col sm={3} className="my-1">
                              Close Balance:&nbsp;
                              <b
                                className={
                                  book.type === "Debit"
                                    ? "text-danger"
                                    : "text-success"
                                }
                              >
                                {book.closing_bal}
                              </b>
                            </Col>
                          </Row>
                        </Card.Subtitle>
                      </Card.Body>
                    </Card>
                  ))
                )}
              </>
            ) : (
              <div className="text-center pt-5">
                <img
                  src="../assets/img/wallet-filled-money-tool.svg"
                  key={1}
                  alt="no_image"
                  width="150"
                />
                <div className="pt-3">
                  You haven't add any amount in your wallet
                </div>
                <div className="py-3 login-btn">
                  <NavLink
                    to="/user/wallet"
                    title="Shop Now"
                    exact
                    className="btn py-1"
                  >
                    Add amount
                  </NavLink>
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
