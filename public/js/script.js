// Import portfolioData from data.js
import { portfolioData } from "./data.js"

// Loading Screen - Remove on initial load
document.addEventListener("DOMContentLoaded", () => {
  const loadingScreen = document.getElementById("loadingScreen")
  if (loadingScreen) {
    setTimeout(() => {
      loadingScreen.classList.remove("active")
    }, 1500)
  }
})

// Page Navigation System
const navButtons = document.querySelectorAll(".nav-btn")
const pages = document.querySelectorAll(".page")
const navToggle = document.getElementById("navToggle")
const navMenu = document.getElementById("navMenu")
const loadingScreen = document.getElementById("loadingScreen")

let currentPage = "home"
let isTransitioning = false

// Navigate to page with loading animation
function navigateToPage(pageId) {
  if (isTransitioning || pageId === currentPage) return

  isTransitioning = true

  // Show loading screen
  loadingScreen.classList.add("active")

  setTimeout(() => {
    // Hide current page
    const currentPageEl = document.getElementById(currentPage)
    if (currentPageEl) {
      currentPageEl.classList.remove("active")
    }

    // Show new page with slide animation
    const newPageEl = document.getElementById(pageId)
    if (newPageEl) {
      newPageEl.classList.add("active")
      newPageEl.style.animation = "slideInRight 0.6s ease-out forwards"

      // Reset animation after it completes
      setTimeout(() => {
        newPageEl.style.animation = ""
      }, 600)
    }

    // Update active nav button
    navButtons.forEach((btn) => {
      btn.classList.remove("active")
      if (btn.getAttribute("data-page") === pageId) {
        btn.classList.add("active")
      }
    })

    currentPage = pageId

    // Hide loading screen
    setTimeout(() => {
      loadingScreen.classList.remove("active")
      isTransitioning = false
    }, 500)
  }, 800)

  // Close mobile menu
  navMenu.classList.remove("active")
}

// Nav button click handlers
navButtons.forEach((button) => {
  button.addEventListener("click", () => {
    const pageId = button.getAttribute("data-page")
    navigateToPage(pageId)
  })
})

// Mobile menu toggle
navToggle.addEventListener("click", () => {
  navToggle.classList.toggle("active")
  navMenu.classList.toggle("active")
})

// Render Services (from data.js)
function renderServices() {
  const servicesGrid = document.getElementById("servicesGrid")
  if (!servicesGrid || !portfolioData) return

  servicesGrid.innerHTML = portfolioData.services
    .map(
      (service) => `
        <div class="service-card">
            <div class="service-icon">${service.icon}</div>
            <h4 class="service-title">${service.title}</h4>
            <p class="service-description">${service.description}</p>
        </div>
    `,
    )
    .join("")
}

// Render Skills (from data.js)
function renderSkills() {
  const skillsGrid = document.getElementById("skillsGrid")
  if (!skillsGrid || !portfolioData || !portfolioData.skills) return

  const categories = [
    { key: 'frontend', label: 'Frontend' },
    { key: 'backend', label: 'Backend' },
    { key: 'database', label: 'Database' },
    { key: 'programming', label: 'Programming & Tools' }
  ]

  let html = ''
  categories.forEach(cat => {
    if (portfolioData.skills[cat.key]) {
      html += `<div class="skills-category">
        <h4 class="category-title">${cat.label}</h4>
        <div class="skills-grid">`
      
      portfolioData.skills[cat.key].forEach(skill => {
        html += `
          <div class="skill-item">
            <div class="skill-header">
              <span class="skill-name">${skill.name}</span>
              <span class="skill-percentage">${skill.percentage}%</span>
            </div>
            <div class="skill-bar-container">
              <div class="skill-bar" style="--skill-width: ${skill.percentage}%"></div>
            </div>
          </div>
        `
      })
      
      html += `</div></div>`
    }
  })

  skillsGrid.innerHTML = html
}

// Render Timeline (from data.js)
function renderTimeline() {
  const timeline = document.getElementById("timeline")
  if (!timeline || !portfolioData) return

  timeline.innerHTML = portfolioData.timeline
    .map(
      (item, index) => `
        <div class="timeline-item" style="animation-delay: ${index * 0.15}s">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <div class="timeline-year">${item.year}</div>
                <h4 class="timeline-degree">${item.degree}</h4>
                <p class="timeline-description">${item.description}</p>
            </div>
        </div>
    `,
    )
    .join("")
}

// Render Major Project (from data.js)
function renderMajorProject() {
  const majorProject = document.getElementById("majorProject")
  if (!majorProject || !portfolioData || !portfolioData.majorProject) return    

  const project = portfolioData.majorProject

  majorProject.innerHTML = `
        <div class="major-project-card">
            <span class="major-badge">FEATURED PROJECT</span>
            <h3 class="major-project-title">${project.title}</h3>
            <p class="major-project-tagline">${project.tagline}</p>
            <div class="project-features">
                ${project.features
                  .map(
                    (feature) => `
                    <div class="feature-item">
                        <div class="feature-icon">${feature.icon}</div>
                        <div>
                            <div class="feature-title">${feature.title}</div>
                            <div class="feature-description">${feature.description}</div>
                        </div>
                    </div>
                `,
                  )
                  .join("")}
            </div>
            <div class="project-tech-stack">
                ${project.techStack.map((tech) => `<span class="tech-tag">${tech}</span>`).join("")}
            </div>
            <a href="${project.link}" class="btn-primary" target="_blank">View Project</a>
        </div>
    `
}

// Render Minor Projects (from data.js)
function renderMinorProjects() {
  const minorProjects = document.getElementById("minorProjects")
  if (!minorProjects || !portfolioData) return

  minorProjects.innerHTML = portfolioData.minorProjects
    .map(
      (project) => `
        <div class="project-card">
            <img src="${project.image}" alt="${project.title}" class="project-image">
            <div class="project-content">
                <h4 class="project-title">${project.title}</h4>
                <p class="project-description">${project.description}</p>
                <div class="project-tags">
                    ${project.tags.map((tag) => `<span class="project-tag">${tag}</span>`).join("")}
                </div>
                <a href="${project.link}" class="project-link" target="_blank">
                    View Project 
                </a>
            </div>
        </div>
    `,
    )
    .join("")
}

// Contact Form
const contactForm = document.getElementById("contactForm")
if (contactForm) {
  contactForm.addEventListener("submit", (e) => {
    e.preventDefault()
    const formData = new FormData(contactForm)
    const data = Object.fromEntries(formData)
    console.log("Form submitted:", data)
    alert("Thank you for your message! I will get back to you soon.")
    contactForm.reset()
  })
}

// Initialize everything when DOM is ready
document.addEventListener("DOMContentLoaded", () => {
  renderServices()
  renderSkills()
  renderTimeline()
  renderMajorProject()
  renderMinorProjects()
})
