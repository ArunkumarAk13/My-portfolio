// Portfolio Data
const portfolioData = {
  // Services / What I Do
  services: [
    {
      icon: "💻",
      title: "Web Development",
      description: "Building responsive and modern web applications using latest technologies and best practices.",
    },
    {
      icon: "🔒",
      title: "Cybersecurity",
      description: "Implementing security measures and conducting vulnerability assessments to protect digital assets.",
    },
    {
      icon: "⚡",
      title: "Performance Optimization",
      description: "Optimizing applications for speed, efficiency, and better user experience.",
    },
  ],

  // Skills organized by category
  skills: {
    frontend: [
      { name: "HTML/CSS", percentage: 90 },
      { name: "JavaScript", percentage: 85 },
      { name: "ReactJS", percentage: 80 },
      { name: "Bootstrap", percentage: 85 },
    ],
    backend: [
      { name: "NodeJS", percentage: 75 },
      { name: "Python", percentage: 80 },
      { name: "REST APIs", percentage: 75 },
      { name: "Express", percentage: 75 },
    ],
    database: [
      { name: "MongoDB", percentage: 70 },
      { name: "SQL", percentage: 75 },
      { name: "Firebase", percentage: 70 },
      { name: "Database Design", percentage: 72 },
    ],
    programming: [
      { name: "Git", percentage: 80 },
      { name: "Problem Solving", percentage: 85 },
      { name: "Data Structures", percentage: 80 },
      { name: "Algorithms", percentage: 78 },
    ],
  },

  // Education Timeline
  timeline: [
    {
      year: "2023 - Present",
      degree: "Bachelor of Technology in Computer Science",
      institution: "University Name",
      description:
        "Pursuing B.Tech with focus on software development, algorithms, and cybersecurity. Active participant in technical clubs and coding competitions.",
    },
    {
      year: "2021 - 2023",
      degree: "Higher Secondary Education",
      institution: "School Name",
      description:
        "Completed higher secondary education with distinction. Specialized in Mathematics, Physics, and Computer Science.",
    },
    {
      year: "2019 - 2021",
      degree: "Secondary Education",
      institution: "School Name",
      description:
        "Completed secondary education with excellent grades. Developed early interest in programming and technology.",
    },
  ],

  // Major Project
  majorProject: {
    title: "LocalHub",
    tagline: "Connecting people to local shopkeepers. Buy. Sell. Trust.",
    description:
      "A comprehensive platform that bridges the gap between local buyers and sellers, enabling efficient commerce with trust and transparency.",
    features: [
      {
        icon: "📤",
        title: "Post Your Need",
        description:
          "Users post their needs under categories like mobiles, electronics, furniture, or any item they are searching for.",
      },
      {
        icon: "🔔",
        title: "Notify Sellers",
        description:
          "Shopkeepers or individual sellers subscribe to specific categories and get notified for relevant posts.",
      },
      {
        icon: "💬",
        title: "Direct Contact",
        description: "Once notified, sellers can directly reach out to buyers using in-app chat or contact info.",
      },
      {
        icon: "🔒",
        title: "Trust & Safety",
        description:
          "Every profile is public with ratings and reviews. High-rated users earn a 'Highly Trusted' badge.",
      },
      {
        icon: "📦",
        title: "Sell Instantly",
        description: "Sellers can respond to real demand immediately, even without a full inventory.",
      },
      {
        icon: "📲",
        title: "Download & Start",
        description:
          "Just download the app, create a profile, and start buying or selling instantly without paperwork.",
      },
    ],
    techStack: ["React Native", "Node.js", "MongoDB", "Express", "Socket.io"],
    link: "https://localhub.example.com",
  },

  // Minor Projects
  minorProjects: [
    {
      title: "Smart Notice Board",
      description: "IoT-based wireless notice board system",
      image: "/smart-notice-board-iot-device.jpg",
      tags: ["IoT", "Embedded Systems"],
      link: "#",
    },
    {
      title: "Gas Leakage Detection",
      description: "Automated gas sensor detection system",
      image: "/gas-sensor-detection-device.jpg",
      tags: ["IoT", "Python"],
      link: "#",
    },
    {
      title: "Water Conservation System",
      description: "IoT based water conservation and monitoring",
      image: "/water-monitoring-iot-system.jpg",
      tags: ["IoT", "Embedded Systems"],
      link: "#",
    },
  ],
}

export { portfolioData }


