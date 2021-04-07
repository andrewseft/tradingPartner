import React, { lazy, useState, useEffect } from "react"
import { Row, Col, Table } from "react-bootstrap"
import { useDispatch, useSelector } from "react-redux"
import { NavLink } from "react-router-dom"
import { getStatementData } from "../../actions/planActions"

const Breadcrumb = lazy(() => import("../../Component/Breadcrumb"))

const Index = (props) => {
  const dispatch = useDispatch()
  const { statement } = useSelector((state) => ({
    statement: state.statement,
  }))
  useEffect(() => {
    const fetchData = () => {
      dispatch(getStatementData())
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
              <h3 className="ml-2">My Statement</h3>
            </div>
          </Col>

          <Col lg={12} className="mt-md-4">
            {statement.length > 0 ? (
              <Table striped bordered hover>
                <thead>
                  <tr>
                    <th scope="col" className="inst">
                      Date
                    </th>
                    <th scope="col">Invested</th>
                    <th scope="col">P&L</th>
                    <th scope="col">%Chg</th>
                  </tr>
                </thead>
                <tbody>
                  {statement.map((item, key) => (
                    <tr key={key}>
                      <td>{item.date}</td>
                      <td>{item.capital}</td>
                      <td
                        className={item.color ? "text-success" : "text-danger"}
                      >
                        {item.pl}
                      </td>
                      <td
                        className={item.color ? "text-success" : "text-danger"}
                      >
                        {item.chg}
                      </td>
                    </tr>
                  ))}
                </tbody>
              </Table>
            ) : (
              <div className="text-center pt-5">
                <img
                  src="../assets/img/orderbook.svg"
                  key={1}
                  alt="no_image"
                  width="150"
                />
                <div className="pt-3">You haven't placed any orders</div>
                <div className="py-3 login-btn">
                  <NavLink
                    to="/user/dashboard"
                    title="Shop Now"
                    exact
                    className="btn py-1"
                  >
                    Dashboard
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
