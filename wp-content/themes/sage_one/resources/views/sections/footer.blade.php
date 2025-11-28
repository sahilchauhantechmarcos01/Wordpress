<footer class="content-info">
  @php(dynamic_sidebar('sidebar-footer'))
  <div class="footer">
    <a class="brand" href="{{ home_url('/') }}">
    {!! $siteName !!}{!!$copy !!}
  </a>

  <div class="footer_right">
      @if (has_nav_menu('primary_navigation'))
    <div class="links_footer" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
</div>
  @endif
  </div>
    </div>
</footer>
