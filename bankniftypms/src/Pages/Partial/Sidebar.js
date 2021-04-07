import React, { useEffect } from "react"
import { useSelector, useDispatch } from "react-redux"
import { getPlanData } from "../../actions/planActions"

const Sidebar = () => {
  const dispatch = useDispatch()
  const { plan } = useSelector((state) => ({
    plan: state.plan,
  }))

  useEffect(() => {
    const fetchData = () => {
      dispatch(getPlanData())
    }
    fetchData()
  }, [dispatch])

  return (
    <>
      <div className="dashboard_sidebar" id="mySidebar">
        <div className="bank_list_sidebar">
          <div className="bank_list_sidebar mt-2">
            {plan.map((item, key) => (
              <div
                className="d-flex justify-content-between align-items-center py-3 bank_list"
                key={key}
              >
                <div className="d-flex align-items-center bank_title">
                  <h6
                    className={
                      item.color ? "m-0  text-success" : "m-0  text-danger"
                    }
                  >
                    {item.title}
                  </h6>
                  {item.tag.map((tag, key) => (
                    <span key={key}>{tag.title}</span>
                  ))}
                  {item.category.map((category, key) => (
                    <span key={key}>{category.title}</span>
                  ))}
                </div>
                <div className="d-flex align-items-center">
                  <div className="bank_rate">
                    <span className="mr-3">{item.pl_percentage}</span>
                    <i
                      className={
                        item.color
                          ? "fa fa-angle-up mr-3 text-success"
                          : "fa fa-angle-down mr-3 text-danger"
                      }
                      aria-hidden="true"
                    ></i>
                  </div>
                  <div className="bank_share">
                    <span
                      className={item.color ? "text-success" : "text-danger"}
                    >
                      {item.amount}
                    </span>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </div>
    </>
  )
}
export default Sidebar
