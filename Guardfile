guard 'phpunit2', :cli => '--colors', tests_path: 'tests' do

  watch(%r{^.+Test\.php$})

  watch(%r{lib/RubyRainbows/IO/(.+)\.php}) { |m| "tests/RubyRainbows/IO/#{m[1]}Test.php" }
end
