import React from "react"
import { Navbar, Nav, Dropdown } from "react-bootstrap"
import { NavLink } from "react-router-dom"
import { useSelector, useDispatch } from "react-redux"
import { userLogout } from "../../actions/userActions"
import { useHistory } from "react-router-dom"
import { checkConform } from "../../utils/helpers"
const { REACT_APP_PUBLIC_URL } = process.env
const Dashboardheader = () => {
  const { userInfo } = useSelector((state) => ({
    userInfo: state.userInfo,
  }))
  const { push } = useHistory()
  const dispatch = useDispatch()
  const handleLogout = (e) => {
    e.preventDefault()
    const afterLogoutCallback = () => {
      dispatch(userLogout(push))
    }
    checkConform(
      afterLogoutCallback,
      "Are you sure you want to logout account?"
    )
  }
  const handleClick = (e) => {
    push(e)
  }
  return (
    <>
      <div className="dashboard_header  bg-white">
        <Navbar expand="lg">
          <NavLink
            className="nav-link"
            exact
            activeClassName="active"
            to="/user/dashboard"
          >
            <img
              src={REACT_APP_PUBLIC_URL + "logo.png"}
              className="dashbaor_logo"
              alt="dashbaor_logo"
            />
          </NavLink>
          <Navbar.Toggle aria-controls="basic-navbar-nav" />
          <Navbar.Collapse id="basic-navbar-nav">
            <Nav className="ml-auto">
              <NavLink
                className="nav-link"
                exact
                activeClassName="active"
                to="/user/dashboard"
              >
                Dashboard
              </NavLink>
              <NavLink
                className="nav-link"
                exact
                activeClassName="active"
                to="/user/order"
              >
                Orders
              </NavLink>
              <NavLink
                className="nav-link"
                exact
                activeClassName="active"
                to="/user/holdings"
              >
                Holdings
              </NavLink>
              <NavLink
                className="nav-link"
                exact
                activeClassName="active"
                to="/user/positions"
              >
                Positions
              </NavLink>
              <NavLink
                className="nav-link"
                exact
                activeClassName="active"
                to="/user/wallet"
              >
                Wallet
              </NavLink>

              <div className="dasheader_right">
                <div className="user">
                  <img src={userInfo.image} alt="userImage" />
                </div>

                <Dropdown>
                  <Dropdown.Toggle variant="" id="dropdown-basic">
                    {userInfo.userId}
                  </Dropdown.Toggle>
                  <Dropdown.Menu>
                    <div className="border-bottom">
                      <Dropdown.Item>
                        <h6>
                          <b>{userInfo.name}</b>
                        </h6>
                        <p className="m-0">{userInfo.email}</p>
                      </Dropdown.Item>
                    </div>
                    <Dropdown.Item
                      onClick={(e) => handleClick("/user/profile")}
                    >
                      <i className="fas fa-user"></i>
                      &nbsp;My profile
                    </Dropdown.Item>
                    <Dropdown.Item
                      onClick={(e) => handleClick("/user/statement")}
                    >
                      <i className="fas fa-book"></i>&nbsp;Statement
                    </Dropdown.Item>
                    <Dropdown.Item
                      onClick={(e) => handleClick("/user/passbook")}
                    >
                      <i className="fas fa-wallet"></i>&nbsp;Passbook
                    </Dropdown.Item>

                    <Dropdown.Item onClick={(e) => handleClick("/contact-us")}>
                      <i className="fas fa-phone-alt"></i>&nbsp;Support
                    </Dropdown.Item>
                    <Dropdown.Item
                      onClick={(e) => handleClick("/user/change-password")}
                    >
                      <i className="fas fa-tools"></i>&nbsp;Change Password
                    </Dropdown.Item>
                    <Dropdown.Item onClick={(e) => handleClick("/referral")}>
                      <i className="fas fa-user-plus"></i>&nbsp;Refer & Earn
                    </Dropdown.Item>
                    <Dropdown.Item
                      onClick={(e) => handleClick("/user/notification")}
                    >
                      <i className="fas fa-bell"></i>&nbsp;Notification
                    </Dropdown.Item>
                    <Dropdown.Item
                      href="#!"
                      className="green"
                      onClick={(e) => handleLogout(e)}
                    >
                      <i className="fas fa-sign-out-alt"></i>&nbsp;Logout
                    </Dropdown.Item>
                  </Dropdown.Menu>
                </Dropdown>
              </div>
            </Nav>
          </Navbar.Collapse>
        </Navbar>
      </div>
    </>
  )
}
export default Dashboardheader
