<!doctype html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Elijah T. Ramos is a frontend developer creating thoughtful web and IoT experiences.">
    <title>Elijah T. Ramos | Frontend Developer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/portfolios/ramos.js'])
</head>
<body>
    <div class="portfolio-page min-h-screen bg-forest font-sans text-[15px] leading-[1.7] text-soft antialiased selection:bg-emerald selection:text-forest">
<a class="fixed left-[10px] top-[10px] z-[100] -translate-y-[150%] bg-mint px-[14px] py-[10px] text-forest focus:translate-y-0" href="#main">Skip to content</a>
  <header class="sticky top-0 z-20 border-b border-mint/[0.08] bg-[rgba(11,21,17,0.91)] backdrop-blur-[16px]">
    <nav class="mx-auto flex min-h-[66px] max-w-6xl items-center justify-between px-5 tablet:min-h-[76px] tablet:px-6 laptop:min-h-[76px] wide:max-w-[1344px] wide:px-[10px]" aria-label="Main navigation">
      <a class="font-display text-2xl font-extrabold text-soft" href="#home" aria-label="Elijah Ramos home">ER<span class="text-emerald">.</span></a>
      <button class="menu-toggle group flex h-[42px] w-[42px] flex-col items-center justify-center gap-[6px] border border-mint/[0.14] bg-transparent tablet:hidden laptop:hidden" type="button" aria-expanded="false" aria-controls="primary-menu" aria-label="Open navigation menu">
        <span class="h-px w-[17px] bg-mint transition-transform group-aria-expanded:translate-y-[3.5px] group-aria-expanded:rotate-45"></span><span class="h-px w-[17px] bg-mint transition-transform group-aria-expanded:-translate-y-[3.5px] group-aria-expanded:-rotate-45"></span>
      </button>
      <div class="nav-links [&.is-open]:flex absolute left-0 right-0 top-[65px] z-20 hidden flex-col items-stretch gap-0 border-b border-mint/[0.08] bg-[rgba(11,21,17,0.98)] px-5 pb-[18px] pt-2 tablet:static tablet:flex tablet:flex-row tablet:items-center tablet:gap-[18px] tablet:border-0 tablet:bg-transparent tablet:p-0 laptop:static laptop:flex laptop:flex-row laptop:items-center laptop:gap-[31px] laptop:border-0 laptop:bg-transparent laptop:p-0" id="primary-menu">
        <a class="nav-link border-b border-mint/[0.08] py-[11px] text-[13px] text-muted transition-colors hover:text-soft tablet:border-0 tablet:p-0 tablet:text-xs [&.is-active]:text-soft after:mx-auto after:mt-1 after:block after:h-1 after:w-1 after:rounded-full after:bg-transparent after:content-[''] [&.is-active]:after:bg-emerald mobile:after:hidden" href="#home" aria-current="location">Home</a>
        <a class="nav-link border-b border-mint/[0.08] py-[11px] text-[13px] text-muted transition-colors hover:text-soft tablet:border-0 tablet:p-0 tablet:text-xs [&.is-active]:text-soft after:mx-auto after:mt-1 after:block after:h-1 after:w-1 after:rounded-full after:bg-transparent after:content-[''] [&.is-active]:after:bg-emerald mobile:after:hidden" href="#about">About</a>
        <a class="nav-link border-b border-mint/[0.08] py-[11px] text-[13px] text-muted transition-colors hover:text-soft tablet:border-0 tablet:p-0 tablet:text-xs [&.is-active]:text-soft after:mx-auto after:mt-1 after:block after:h-1 after:w-1 after:rounded-full after:bg-transparent after:content-[''] [&.is-active]:after:bg-emerald mobile:after:hidden" href="#skills">Skills</a>
        <a class="nav-link border-b border-mint/[0.08] py-[11px] text-[13px] text-muted transition-colors hover:text-soft tablet:border-0 tablet:p-0 tablet:text-xs [&.is-active]:text-soft after:mx-auto after:mt-1 after:block after:h-1 after:w-1 after:rounded-full after:bg-transparent after:content-[''] [&.is-active]:after:bg-emerald mobile:after:hidden" href="#projects">Projects</a>
        <a class="nav-link border-b border-mint/[0.08] py-[11px] text-[13px] text-muted transition-colors hover:text-soft tablet:border-0 tablet:p-0 tablet:text-xs [&.is-active]:text-soft after:mx-auto after:mt-1 after:block after:h-1 after:w-1 after:rounded-full after:bg-transparent after:content-[''] [&.is-active]:after:bg-emerald mobile:after:hidden" href="#journey">Journey</a>
        <a class="mt-[13px] border border-emerald/[0.52] px-[14px] py-[9px] text-center text-xs text-mint transition-colors hover:bg-emerald-rich hover:text-soft tablet:mt-0" href="#contact">Let's talk <span class="pl-[9px] text-emerald" aria-hidden="true">↗</span></a>
        @can('manage-projects')
          <a class="mt-[13px] border border-emerald/[0.52] bg-emerald/[0.08] px-[14px] py-[9px] text-center text-xs text-mint transition-colors hover:bg-emerald-rich hover:text-soft tablet:mt-0" href="{{ route('projects.index') }}">Manage Projects</a>
        @endcan
        <form method="POST" action="{{ route('logout') }}" class="mt-[13px] tablet:mt-0">
          @csrf
          <button type="submit" class="w-full border border-[#c77b75]/50 px-[14px] py-[9px] text-center text-xs text-[#e2a39b] transition-colors hover:bg-[#6a3232] hover:text-soft tablet:w-auto">Log out</button>
        </form>
      </div>
    </nav>
  </header>

  <main id="main">
    <section class="relative isolate min-h-0 overflow-hidden bg-[radial-gradient(ellipse_at_79%_48%,rgba(36,118,83,0.18),transparent_34%),radial-gradient(ellipse_at_3%_79%,rgba(85,167,131,0.07),transparent_25%)] tablet:min-h-[620px] laptop:min-h-[690px] laptop-max:min-h-[620px] wide:min-h-[762px]" id="home" aria-labelledby="hero-title">
      <div class="mx-auto grid min-h-0 max-w-6xl translate-y-2 items-center gap-1 px-[22px] py-[56px] tablet:min-h-[560px] tablet:translate-y-1 tablet:gap-[25px] tablet:px-6 tablet:py-0 laptop:min-h-[612px] laptop:translate-y-0 laptop:grid-cols-2 laptop:gap-4 laptop:py-0 laptop-max:min-h-[560px] laptop-max:gap-[25px] laptop-max:px-6 laptop-max:py-0 wide:min-h-[700px] wide:translate-y-2 wide:max-w-[1344px] wide:px-[50px]">
        <div class="relative z-10 py-0 tablet:py-[45px] tablet:pb-[55px] laptop:py-[45px] laptop:pb-[55px] wide:translate-y-5">
          <p class="m-0 flex items-center gap-[10px] text-[9px] font-bold tracking-[1.1px] text-emerald tablet:text-[10px] laptop:text-xs"><span class="h-[7px] w-[7px] shrink-0 rounded-full bg-emerald shadow-[0_0_14px_rgba(85,167,131,0.55)]" aria-hidden="true"></span> FRONTEND DEVELOPER · TARLAC, PH</p>
          <h1 class="mb-4 mt-5 font-display text-[clamp(54px,15vw,70px)] font-bold leading-[1.04] compact:text-[50px] tablet:text-[64px] laptop:mb-4 laptop:mt-[22px] laptop:text-[clamp(90px,8.5vw,112px)] wide:mt-[34px] wide:text-[clamp(96px,8.5vw,120px)]" id="hero-title">Elijah T.<br><span class="text-emerald">Ramos</span></h1>
          <p class="m-0 max-w-[445px] text-[15px] leading-[1.8] text-muted laptop:max-w-[560px] laptop:text-[20px]">I build thoughtful digital experiences with a spark of creativity and a hands-on love for technology.</p>
          <div class="mt-[31px] flex flex-wrap items-center gap-4 laptop:mt-[38px]">
            <a class="inline-flex min-h-12 items-center justify-center gap-[18px] border border-transparent bg-emerald-rich px-[17px] text-[19px] font-bold text-soft transition duration-200 hover:-translate-y-0.5 hover:bg-[#206a4a] laptop:min-h-[60px] laptop:px-5 laptop:text-[22px]" href="#projects">Explore my work <span class="text-[19px]" aria-hidden="true">↗</span></a>
            <a class="text-xs text-mint" href="#contact">Get in touch <span class="pl-[7px] text-emerald" aria-hidden="true">→</span></a>
          </div>
          <div class="mt-[34px] flex items-center gap-[10px] text-[11px] text-muted tablet:mt-[69px] laptop:mt-[55px] wide:mt-[65px]"><span class="h-px w-[25px] bg-emerald" aria-hidden="true"></span> Curious by nature. Building with purpose.</div>
        </div>
        <div class="relative mx-[-12px] grid min-h-[370px] place-items-center compact:min-h-[335px] tablet:mx-0 tablet:min-h-[430px] laptop:ml-[-32px] laptop:min-h-[480px] laptop:w-[390px] laptop:justify-self-start laptop-max:min-h-[430px] wide:ml-[-16px] wide:min-h-[520px] laptop:translate-x-[72px]" aria-label="Decorative profile illustration">
          <div class="absolute h-[300px] w-[300px] rounded-full border border-emerald/20 tablet:h-[340px] tablet:w-[340px] laptop:h-[468px] laptop:w-[468px] laptop-max:h-[340px] laptop-max:w-[340px]" aria-hidden="true"></div>
          <div class="absolute h-[240px] w-[240px] rounded-full border border-mint/[0.12] tablet:h-[275px] tablet:w-[275px] laptop:h-[372px] laptop:w-[372px] laptop-max:h-[275px] laptop-max:w-[275px]" aria-hidden="true"></div>
          <div class="absolute h-[83%] w-[90%] opacity-[0.17] [background-image:linear-gradient(rgba(199,213,204,0.13)_1px,transparent_1px),linear-gradient(90deg,rgba(199,213,204,0.13)_1px,transparent_1px)] [background-size:39px_39px] [-webkit-mask-image:radial-gradient(ellipse,#000_12%,transparent_72%)] [mask-image:radial-gradient(ellipse,#000_12%,transparent_72%)]" aria-hidden="true"></div>
          <div class="relative flex h-[280px] w-[220px] animate-float-in flex-col items-center justify-center border border-mint/20 bg-[linear-gradient(145deg,rgba(32,51,41,0.94),rgba(18,34,26,0.9))] shadow-[0_24px_90px_rgba(0,0,0,0.3)] compact:h-[255px] compact:w-[200px] tablet:h-[326px] tablet:w-[258px] laptop:h-[392px] laptop:w-[310px]">
            <div class="absolute inset-0 overflow-hidden">
              <img class="h-full w-full object-cover object-[55%_50%]" src="/portfolio-assets/profile.jpg" alt="Portrait of Elijah Ramos holding a red rose">
              <span class="absolute inset-0 bg-gradient-to-t from-forest via-forest/10 to-transparent" aria-hidden="true"></span>
              <span class="absolute inset-0 bg-emerald-rich/10 mix-blend-multiply" aria-hidden="true"></span>
            </div>
            <span class="absolute -left-[7px] -top-[7px] z-10 h-[27px] w-[27px] border-l border-t border-emerald" aria-hidden="true"></span>
            <span class="absolute -bottom-[7px] -right-[7px] z-10 h-[27px] w-[27px] border-b border-r border-emerald" aria-hidden="true"></span>
            <span class="absolute inset-x-0 bottom-4 z-10 text-center text-[9px] tracking-[1.8px] text-mint">DESIGN · CODE · CONNECT</span>
            <span class="absolute right-5 top-[18px] z-10 text-[17px] text-emerald" aria-hidden="true">✳</span>
          </div>
          <span class="absolute left-[2%] top-[21%] border border-mint/20 bg-[#14231b] px-[11px] py-2 font-mono text-[9px] text-emerald shadow-[0_8px_28px_rgba(0,0,0,0.2)] tablet:text-[10px]">&lt;build /&gt;</span>
          <span class="absolute bottom-[21%] right-[1%] flex items-center gap-2 border border-mint/20 bg-[#14231b] px-[11px] py-2 text-[9px] text-mint shadow-[0_8px_28px_rgba(0,0,0,0.2)] tablet:right-0 tablet:text-[10px]"><span class="h-[7px] w-[7px] rounded-full bg-emerald shadow-[0_0_14px_rgba(85,167,131,0.55)]" aria-hidden="true"></span> IoT curious</span>
          <span class="absolute bottom-[4%] right-[7%] font-mono text-[10px] text-[#71877a]">01 / 06</span>
        </div>
      </div>
      <a class="absolute bottom-[22px] left-6 hidden items-center gap-[10px] text-[9px] tracking-[1.3px] text-[#809188] tablet:flex laptop:flex" href="#about"><span class="text-[17px] text-emerald" aria-hidden="true">↓</span> SCROLL TO EXPLORE</a>
    </section>

    <section class="relative overflow-hidden border-t border-mint/[0.08] py-[75px] tablet:py-[90px] laptop:py-[112px] laptop-max:py-[90px]" id="about" aria-labelledby="about-title">
      <div class="mx-auto max-w-6xl wide:max-w-[1344px] wide:px-[50px] px-[22px] tablet:px-6">
        <p class="m-0 flex items-center gap-[10px] text-[10px] font-bold tracking-[1.1px] text-emerald">A LITTLE ABOUT ME <span class="h-px w-[29px] bg-emerald/60" aria-hidden="true"></span> 01</p>
        <h2 class="mb-0 mt-[19px] font-display text-[42px] font-semibold leading-[1.16] compact:text-[37px] tablet:text-[48px] laptop:text-[clamp(36px,5vw,55px)]" id="about-title">Curiosity makes<br><span class="text-emerald">good things happen.</span></h2>
      </div>
      <div class="mx-auto mt-8 grid max-w-6xl wide:max-w-[1344px] wide:px-[50px] gap-8 px-[22px] tablet:mt-[50px] tablet:grid-cols-2 tablet:gap-12 tablet:px-6 laptop:gap-12">
        <div class="max-w-[540px] text-muted">
          <p class="mb-[17px] font-display text-[17px] leading-[1.7] text-mint tablet:text-[19px]">I'm Elijah, a passionate designer and full-stack developer dedicated to creating modern, user-friendly digital experiences.</p>
          <p class="mb-[17px]">With an interest in web design, UI/UX, frontend development, and connected devices, I enjoy turning ideas into interactive solutions that feel as good to use as they look.</p>
          <p class="mb-[17px]">My approach pairs creativity with technical care, so each project is both expressive and practical.</p>
        </div>
        <aside class="relative border border-mint/[0.14] bg-[linear-gradient(130deg,rgba(25,40,32,0.94),rgba(16,30,23,0.7))] p-[23px] tablet:p-[28px_30px]" aria-label="My goal">
          <span class="mb-[25px] inline-grid h-[37px] w-[37px] place-items-center border border-emerald/40 text-emerald" aria-hidden="true">✳</span>
          <p class="m-0 flex items-center gap-[10px] text-[10px] font-bold tracking-[1.1px] text-emerald">WHAT I'M WORKING TOWARD</p>
          <h3 class="mb-[11px] mt-[11px] max-w-[390px] font-display text-[25px] leading-[1.35]">Make useful technology feel human.</h3>
          <p class="m-0 max-w-[400px] text-[13px] text-muted">I want to keep growing as a developer and designer, building accessible web experiences and exploring how software can connect with the world around us.</p>
        </aside>
      </div>
    </section>

    <section class="relative overflow-hidden border-t border-mint/[0.08] bg-[linear-gradient(180deg,rgba(25,40,32,0.34),transparent_64%)] py-[75px] tablet:py-[90px] laptop:py-[112px] laptop-max:py-[90px]" id="skills" aria-labelledby="skills-title">
      <div class="mx-auto max-w-6xl wide:max-w-[1344px] wide:px-[50px] px-[22px] tablet:px-6">
        <p class="m-0 flex items-center gap-[10px] text-[10px] font-bold tracking-[1.1px] text-emerald">MY TOOLKIT <span class="h-px w-[29px] bg-emerald/60" aria-hidden="true"></span> 02</p>
        <h2 class="mb-0 mt-[19px] font-display text-[42px] font-semibold leading-[1.16] compact:text-[37px] tablet:text-[48px] laptop:text-[clamp(36px,5vw,55px)]" id="skills-title">Things I like<br><span class="text-emerald">to make and use.</span></h2>
      </div>
      <div class="mx-auto mt-8 grid max-w-6xl wide:max-w-[1344px] wide:px-[50px] gap-8 px-[22px] tablet:mt-[50px] tablet:grid-cols-2 tablet:gap-12 tablet:px-6 laptop:gap-12">
        <div>
          <h3 class="mb-[18px] mt-0 font-display text-[15px] font-semibold text-mint">Technical skills</h3>
          <div class="border-t border-mint/[0.14]">
            <article class="flex min-h-[66px] items-center gap-[14px] border-b border-mint/[0.14]"><span class="grid h-[35px] w-[35px] shrink-0 place-items-center border border-emerald/[0.23] font-mono text-xs text-emerald" aria-hidden="true">&lt;/&gt;</span><div><h4 class="m-0 text-xs font-semibold text-mint">HTML &amp; Web</h4><p class="m-0 mt-px text-[10px] text-[#8d9e94]">Building blocks for the web</p></div><span class="ml-auto text-[13px] text-[#60796b]" aria-hidden="true">↗</span></article>
            <article class="flex min-h-[66px] items-center gap-[14px] border-b border-mint/[0.14]"><span class="grid h-[35px] w-[35px] shrink-0 place-items-center border border-emerald/[0.23] font-mono text-lg text-emerald" aria-hidden="true">◉</span><div><h4 class="m-0 text-xs font-semibold text-mint">3D Blender</h4><p class="m-0 mt-px text-[10px] text-[#8d9e94]">Modeling and visual design</p></div><span class="ml-auto text-[13px] text-[#60796b]" aria-hidden="true">↗</span></article>
            <article class="flex min-h-[66px] items-center gap-[14px] border-b border-mint/[0.14]"><span class="grid h-[35px] w-[35px] shrink-0 place-items-center border border-emerald/[0.23] font-display text-xs font-bold text-emerald" aria-hidden="true">F</span><div><h4 class="m-0 text-xs font-semibold text-mint">Figma</h4><p class="m-0 mt-px text-[10px] text-[#8d9e94]">Interface ideas and prototypes</p></div><span class="ml-auto text-[13px] text-[#60796b]" aria-hidden="true">↗</span></article>
            <article class="flex min-h-[66px] items-center gap-[14px] border-b border-mint/[0.14]"><span class="grid h-[35px] w-[35px] shrink-0 place-items-center border border-emerald/[0.23] font-mono text-xs text-emerald" aria-hidden="true">⌘</span><div><h4 class="m-0 text-xs font-semibold text-mint">GitHub</h4><p class="m-0 mt-px text-[10px] text-[#8d9e94]">Version control and collaboration</p></div><span class="ml-auto text-[13px] text-[#60796b]" aria-hidden="true">↗</span></article>
            <article class="flex min-h-[66px] items-center gap-[14px] border-b border-mint/[0.14]"><span class="grid h-[35px] w-[35px] shrink-0 place-items-center border border-emerald/[0.23] font-mono text-xs text-emerald" aria-hidden="true">▱</span><div><h4 class="m-0 text-xs font-semibold text-mint">Flutter app development</h4><p class="m-0 mt-px text-[10px] text-[#8d9e94]">Exploring cross-platform apps</p></div><span class="ml-auto text-[13px] text-[#60796b]" aria-hidden="true">↗</span></article>
            <article class="flex min-h-[66px] items-center gap-[14px] border-b border-mint/[0.14]"><span class="grid h-[35px] w-[35px] shrink-0 place-items-center border border-emerald/[0.23] font-mono text-xs text-emerald" aria-hidden="true">⌁</span><div><h4 class="m-0 text-xs font-semibold text-mint">IoT projects</h4><p class="m-0 mt-px text-[10px] text-[#8d9e94]">ESP32 and connected devices</p></div><span class="ml-auto text-[13px] text-[#60796b]" aria-hidden="true">↗</span></article>
          </div>
        </div>
        <div>
          <h3 class="mb-[18px] mt-0 font-display text-[15px] font-semibold text-mint">How I work</h3>
          <p class="mb-[22px] mt-0 max-w-[395px] text-sm text-muted">Good work takes more than tools. I bring curiosity, care, and a willingness to learn into every collaboration.</p>
          <div class="flex flex-wrap gap-[9px]" aria-label="Professional strengths"><span class="border border-mint/[0.17] px-[10px] py-[7px] text-[10px] text-mint">Creative thinking</span><span class="border border-mint/[0.17] px-[10px] py-[7px] text-[10px] text-mint">Problem solving</span><span class="border border-mint/[0.17] px-[10px] py-[7px] text-[10px] text-mint">Collaboration</span><span class="border border-mint/[0.17] px-[10px] py-[7px] text-[10px] text-mint">Attention to detail</span><span class="border border-mint/[0.17] px-[10px] py-[7px] text-[10px] text-mint">Continuous learning</span></div>
          <div class="mt-[47px] flex items-start gap-3 border-t border-mint/[0.14] pt-[19px]"><span class="text-emerald" aria-hidden="true">✳</span><p class="m-0 max-w-[340px] text-xs text-muted">Currently curious about the space where <strong class="font-medium text-mint">design, code, and hardware</strong> meet.</p></div>
        </div>
      </div>
    </section>

    <section class="relative overflow-hidden border-t border-mint/[0.08] bg-[#101c16] py-[75px] tablet:py-[90px] laptop:py-[112px] laptop-max:py-[90px]" id="projects" aria-labelledby="projects-title">
      <div class="mx-auto mb-[23px] flex -translate-y-2 max-w-6xl wide:max-w-[1344px] wide:px-[50px] items-start justify-between gap-[15px] px-[22px] tablet:mb-[34px] tablet:items-end tablet:px-6">
        <div><p class="m-0 flex items-center gap-[10px] text-[10px] font-bold tracking-[1.1px] text-emerald">SELECTED BUILDS <span class="h-px w-[29px] bg-emerald/60" aria-hidden="true"></span> 03</p><h2 class="mb-0 mt-[19px] font-display text-[42px] font-semibold leading-[1.16] compact:text-[37px] tablet:text-[48px] laptop:text-[clamp(36px,5vw,55px)]" id="projects-title">Made with<br><span class="text-emerald">curiosity.</span></h2></div>
        <p class="mb-[6px] mt-0 hidden text-xs leading-[1.7] text-muted tablet:block">A few experiments in code,<br>music, and connected things.</p>
      </div>
      <div class="mx-auto grid -translate-y-2 max-w-6xl wide:max-w-[1344px] wide:px-[50px] grid-cols-1 gap-5 px-[22px] tablet:grid-cols-2 tablet:px-6 laptop:grid-cols-3">
        @forelse ($projects as $project)
          <article class="group min-w-0 border border-mint/[0.13] bg-pine/60 transition-[border-color,transform] duration-300 hover:-translate-y-1 hover:border-emerald/50">
            @if ($project->image_url)
              <a class="relative block h-[240px] overflow-hidden bg-pine" href="{{ $project->project_url ?: ($project->repository_url ?: '#contact') }}" aria-label="View {{ $project->title }} project">
                <img class="h-full w-full object-cover opacity-[0.74] transition duration-500 group-hover:scale-[1.035] group-hover:opacity-90" src="{{ $project->image_url }}" alt="{{ $project->title }} project image" loading="lazy">
                <span class="pointer-events-none absolute inset-x-0 bottom-0 top-[45%] bg-gradient-to-t from-forest/50 to-transparent"></span>
                <span class="absolute bottom-[14px] left-[15px] z-10 text-[9px] tracking-[1px] text-soft">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }} / {{ strtoupper($project->portfolio) }}</span>
                <span class="absolute bottom-[10px] right-[14px] z-10 text-lg text-mint" aria-hidden="true">↗</span>
              </a>
            @endif
            <div class="px-[19px] pb-[19px] pt-5">
              <p class="mb-[9px] mt-0 text-[9px] font-bold tracking-[1px] text-emerald">{{ strtoupper($project->portfolio) }} PROJECT{{ $project->completed_at ? ' · '.$project->completed_at->format('Y') : '' }}</p>
              <h3 class="mb-[9px] mt-0 font-display text-[19px] font-semibold leading-[1.35]">{{ $project->title }}</h3>
              <p class="m-0 min-h-[66px] text-xs leading-[1.7] text-muted">{{ $project->description }}</p>
              @if ($project->project_note)
                <p class="mt-3 border-l border-emerald/50 pl-3 text-xs italic leading-[1.7] text-[#b7c8be]">
                  <span class="font-semibold not-italic text-emerald">Note:</span>
                  {{ $project->project_note }}
                </p>
              @endif
              <div class="mt-[17px] flex flex-wrap gap-[7px]">
                @foreach ($project->tech_stack as $technology)
                  <span class="border border-mint/[0.17] px-2 py-[5px] text-[9px] text-[#b7c8be]">{{ $technology }}</span>
                @endforeach
              </div>
              @if ($project->project_url || $project->repository_url)
                <a class="mt-4 inline-flex text-xs text-mint hover:text-emerald" href="{{ $project->project_url ?: $project->repository_url }}" target="_blank" rel="noopener noreferrer">View project ↗</a>
              @endif
            </div>
          </article>
        @empty
          <p class="col-span-full text-sm text-muted">Projects will be added soon.</p>
        @endforelse
      </div>
    </section>

    <section class="relative overflow-hidden border-t border-mint/[0.08] py-[75px] tablet:py-[90px] laptop:py-[112px] laptop-max:py-[90px]" id="journey" aria-labelledby="journey-title">
      <div class="mx-auto grid max-w-6xl wide:max-w-[1344px] wide:px-[50px] gap-9 px-[22px] tablet:grid-cols-2 tablet:gap-12 tablet:px-6">
        <div><p class="m-0 flex items-center gap-[10px] text-[10px] font-bold tracking-[1.1px] text-emerald">LEARNING &amp; EXPERIENCE <span class="h-px w-[29px] bg-emerald/60" aria-hidden="true"></span> 04</p><h2 class="mb-0 mt-[19px] font-display text-[42px] font-semibold leading-[1.16] compact:text-[37px] tablet:text-[48px] laptop:text-[clamp(36px,5vw,55px)]" id="journey-title">A path built<br><span class="text-emerald">by trying.</span></h2><p class="mb-0 mt-[22px] max-w-[320px] text-[13px] text-muted">Each project, contest, and conversation gives me another reason to keep learning.</p></div>
        <div class="border-l border-emerald/[0.38] pl-7">
          <article class="relative pb-[30px]"><span class="absolute -left-[33px] top-[5px] h-[9px] w-[9px] rounded-full border-2 border-emerald bg-forest" aria-hidden="true"></span><p class="mb-[7px] mt-0 text-[9px] font-bold tracking-[1px] text-emerald">AWARD · 3D DESIGN</p><h3 class="mb-[5px] mt-0 font-display text-base font-semibold text-mint">First place, Blender contest</h3><p class="m-0 max-w-[425px] text-xs text-muted">Won first place in a 3D Blender contest at Lumar Colleges in La Union.</p></article>
          <article class="relative pb-[30px]"><span class="absolute -left-[33px] top-[5px] h-[9px] w-[9px] rounded-full border-2 border-emerald bg-forest" aria-hidden="true"></span><p class="mb-[7px] mt-0 text-[9px] font-bold tracking-[1px] text-emerald">PEER MENTORING · IOT</p><h3 class="mb-[5px] mt-0 font-display text-base font-semibold text-mint">Helping students build</h3><p class="m-0 max-w-[425px] text-xs text-muted">Helped senior high school students create an IoT project using an ESP32 and ultrasonic sensor.</p></article>
          <article class="relative pb-[30px]"><span class="absolute -left-[33px] top-[5px] h-[9px] w-[9px] rounded-full border-2 border-emerald bg-forest" aria-hidden="true"></span><p class="mb-[7px] mt-0 text-[9px] font-bold tracking-[1px] text-emerald">ONGOING LEARNING · RESEARCH</p><h3 class="mb-[5px] mt-0 font-display text-base font-semibold text-mint">Seminars on capstone &amp; research</h3><p class="m-0 max-w-[425px] text-xs text-muted">Joined seminars focused on capstone projects and research to strengthen my academic and technical skills.</p></article>
          <article class="relative"><span class="absolute -left-[33px] top-[5px] h-[9px] w-[9px] rounded-full border-2 border-emerald bg-forest" aria-hidden="true"></span><p class="mb-[7px] mt-0 text-[9px] font-bold tracking-[1px] text-emerald">EDUCATION</p><h3 class="mb-[5px] mt-0 font-display text-base font-semibold text-mint">Advanced Web Development</h3><p class="m-0 max-w-[425px] text-xs text-muted">Currently developing my web design and frontend skills through my third-year elective studies.</p></article>
        </div>
      </div>
    </section>

    <section class="relative overflow-hidden border-t border-mint/[0.08] bg-[radial-gradient(ellipse_at_11%_86%,rgba(36,118,83,0.13),transparent_37%),#101c16] py-[75px] tablet:py-[90px] laptop:py-[105px]" id="contact" aria-labelledby="contact-title">
      <div class="mx-auto grid max-w-6xl wide:max-w-[1344px] wide:px-[50px] gap-8 px-[22px] tablet:grid-cols-2 tablet:gap-12 tablet:px-6">
        <div><p class="m-0 flex items-center gap-[10px] text-[10px] font-bold tracking-[1.1px] text-emerald">SAY HELLO <span class="h-px w-[29px] bg-emerald/60" aria-hidden="true"></span> 05</p><h2 class="mb-[18px] mt-[19px] font-display text-[42px] font-semibold leading-[1.16] compact:text-[37px] tablet:text-[48px] laptop:text-[clamp(36px,5vw,55px)]" id="contact-title">Have an idea?<br><span class="text-emerald">Let's make it real.</span></h2><p class="m-0 max-w-[385px] text-[13px] text-muted">Have a project, a question, or just want to talk about design and tech? Send me a note.</p>
          <div class="mt-[33px] border-t border-mint/[0.14]">
            <a class="flex min-h-16 items-center gap-[14px] border-b border-mint/[0.14] text-xs text-mint hover:text-emerald" href="mailto:elijahramos922@gmail.com"><span class="grid h-[33px] w-[33px] shrink-0 place-items-center border border-emerald/[0.27] text-sm text-emerald" aria-hidden="true">@</span><span><small class="mb-[2px] block text-[8px] tracking-[1px] text-[#8d9e94]">EMAIL</small>elijahramos922@gmail.com</span><span class="ml-auto text-[#8d9e94]" aria-hidden="true">↗</span></a>
            <a class="flex min-h-16 items-center gap-[14px] border-b border-mint/[0.14] text-xs text-mint hover:text-emerald" href="tel:+639631686312"><span class="grid h-[33px] w-[33px] shrink-0 place-items-center border border-emerald/[0.27] text-sm text-emerald" aria-hidden="true">⌕</span><span><small class="mb-[2px] block text-[8px] tracking-[1px] text-[#8d9e94]">PHONE</small>+63 963 1686 312</span><span class="ml-auto text-[#8d9e94]" aria-hidden="true">↗</span></a>
            <div class="flex min-h-16 items-center gap-[14px] border-b border-mint/[0.14] text-xs text-mint"><span class="grid h-[33px] w-[33px] shrink-0 place-items-center border border-emerald/[0.27] text-sm text-emerald" aria-hidden="true">⌖</span><span><small class="mb-[2px] block text-[8px] tracking-[1px] text-[#8d9e94]">LOCATION</small>Burgos, Moncada, Tarlac</span></div>
          </div>
          <a class="mt-[21px] inline-flex gap-[11px] text-[11px] text-mint" href="https://www.facebook.com/share/1DvudxiDd3/" target="_blank" rel="noopener noreferrer">Facebook <span class="text-emerald" aria-hidden="true">↗</span></a>
        </div>
        <form class="contact-form border border-mint/[0.15] bg-forest/60 px-[19px] py-[22px] tablet:px-[29px] tablet:pb-[22px] tablet:pt-[27px]" id="contact-form">
          <div class="mb-[17px] flex items-center justify-between"><span class="text-[10px] font-bold tracking-[1.1px] text-emerald">DROP A MESSAGE</span><span class="text-emerald" aria-hidden="true">✳</span></div>
          <div class="mt-[15px]"><label class="mb-[6px] block text-[11px] font-medium text-mint" for="name">Your name</label><input class="block w-full resize-y border border-mint/[0.17] bg-pine/55 px-3 py-[11px] text-xs text-soft transition-colors placeholder:text-[#84958b] focus:border-emerald focus:outline-none [&:invalid:not(:placeholder-shown)]:border-[#c77b75]" id="name" name="name" type="text" autocomplete="name" placeholder="How should I address you?" required minlength="2"></div>
          <div class="mt-[15px]"><label class="mb-[6px] block text-[11px] font-medium text-mint" for="email">Email address</label><input class="block w-full resize-y border border-mint/[0.17] bg-pine/55 px-3 py-[11px] text-xs text-soft transition-colors placeholder:text-[#84958b] focus:border-emerald focus:outline-none [&:invalid:not(:placeholder-shown)]:border-[#c77b75]" id="email" name="email" type="email" autocomplete="email" placeholder="you@example.com" required></div>
          <div class="mt-[15px]"><label class="mb-[6px] block text-[11px] font-medium text-mint" for="message">Your message</label><textarea class="block w-full resize-y border border-mint/[0.17] bg-pine/55 px-3 py-[11px] text-xs text-soft transition-colors placeholder:text-[#84958b] focus:border-emerald focus:outline-none [&:invalid:not(:placeholder-shown)]:border-[#c77b75]" id="message" name="message" rows="4" placeholder="Tell me a little about it..." required minlength="10"></textarea></div>
          <button class="mt-5 inline-flex min-h-12 w-full items-center justify-center gap-[18px] border border-transparent bg-emerald-rich px-[17px] text-[19px] font-bold text-soft transition duration-200 hover:-translate-y-0.5 hover:bg-[#206a4a]" type="submit">Send a message <span class="text-[19px]" aria-hidden="true">↗</span></button>
          <p class="mt-[13px] text-xs text-[#8ed0a8]" id="form-feedback" role="status" aria-live="polite" hidden></p>
          <p class="mb-0 mt-3 text-center text-[10px] text-[#8d9e94]">This demo form validates your message in the browser and does not send or store it.</p>
        </form>
      </div>
    </section>
  </main>

  <footer class="border-t border-mint/10 bg-forest">
    <div class="mx-auto flex min-h-[75px] max-w-6xl wide:max-w-[1344px] wide:px-[50px] flex-wrap items-center justify-between gap-4 px-5 tablet:min-h-[76px] tablet:px-6">
      <a class="font-display text-2xl font-extrabold text-soft" href="#home" aria-label="Back to top">ER<span class="text-emerald">.</span></a>
      <p class="order-3 mb-0 w-full pb-[15px] text-center text-[10px] text-[#8d9e94] tablet:order-none tablet:mb-0 tablet:w-auto tablet:pb-0">Designed &amp; built by Elijah Ramos <span class="px-[5px] text-emerald" aria-hidden="true">·</span> 2026</p>
      <a class="text-[10px] text-mint" href="#home">Back to top <span class="pl-[7px] text-emerald" aria-hidden="true">↑</span></a>
    </div>
  </footer>
    </div>
</body>
</html>